<?php
/**
* phpBB Extension - marttiphpbb menuitems
* @copyright (c) 2014 - 2019 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menuitems\console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use phpbb\console\command\command;
use phpbb\user;
use marttiphpbb\menuitems\util\cnst;

class generate extends command
{
	const PATH = __DIR__ . '/../styles/prosilver/template/event/';
	const TPL_VAR = 'marttiphpbb_menuitems.items';
	const TPL_CLASS_FOOTER = ' class="rightside"';
	const TPL = <<<'EOT'
{#- This file was generated with command ext-menuitems:generate -#}
{%- if %var%.%name% -%}
	{%- for item in %var%.%name% -%}
		<li%class% data-last-responsive="true">
			<a href="{{- item.link -}}" role="menuitem" aria-hidden="true">
				{%- include item.include with {'var': item.var, 'key': item.key} only -%}
			</a>
		</li>
	{%- endfor -%}
{%- endif -%}
EOT;

	public function __construct(user $user)
	{
		parent::__construct($user);
	}

	protected function configure()
	{
		$this
			->setName('ext-menuitems:generate')
			->setDescription('For internal development use.')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$io = new SymfonyStyle($input, $output);

		$outputStyle = new OutputFormatterStyle('white', 'black', ['bold']);
		$output->getFormatter()->setStyle('v', $outputStyle);

		$io->writeln([
			'<comment>',
			'Generate menu template event listeners',
			'--------------------------------------',
			'</>',
		]);

		foreach (cnst::ITEMS as $name)
		{
			$class = strpos($name, 'overall_footer_') === 0 ? self::TPL_CLASS_FOOTER : '';
			$search = ['%name%', '%var%', '%class%'];
			$replace = [$name, self::TPL_VAR, $class];
			$content = str_replace($search, $replace, self::TPL);

			file_put_contents(self::PATH . $name . '.html', $content);

			$io->writeln('<info>Listener generated: </><v>' . $name . '</>');
		}

		$io->writeln('');
	}
}
