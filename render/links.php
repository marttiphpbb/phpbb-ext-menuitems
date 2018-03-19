<?php
/**
* phpBB Extension - marttiphpbb menulinks
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menulinks\render;

use phpbb\config\config;
use phpbb\template\template;
use phpbb\language\language;

class links
{
	/* @var config */
	private $config;

	/* @var template */
	private $template;

	/* @var language */
	private $language;

	private $links = [
		1		=> 'RESERVED',
		2		=> 'OVERALL_HEADER_NAVIGATION_PREPEND',
		4		=> 'OVERALL_HEADER_NAVIGATION_APPEND',
		8		=> 'NAVBAR_HEADER_QUICK_LINKS_BEFORE',
		16		=> 'NAVBAR_HEADER_QUICK_LINKS_AFTER',
		32		=> 'OVERALL_HEADER_BREADCRUMBS_BEFORE',
		64		=> 'OVERALL_HEADER_BREADCRUMBS_AFTER',
		128		=> 'OVERALL_FOOTER_TIMEZONE_BEFORE',
		256		=> 'OVERALL_FOOTER_TIMEZONE_AFTER',
		512		=> 'OVERALL_FOOTER_TEAMLINK_BEFORE',
		1024	=> 'OVERALL_FOOTER_TEAMLINK_AFTER',
	];

	/**
	* @param config		$config
	* @param template	$template
	* @param language 	$language
	* @return links
	*/
	public function __construct(
		config $config,
		template $template,
		language $language
	)
	{
		$this->config = $config;
		$this->template = $template;
		$this->language = $language;
	}

	/*
	 * @return self
	 */
	public function assign_template_vars():self
	{
		$links_enabled = $this->config['menulinks_links'];
		$template_vars = [];

		foreach ($this->links as $key => $value)
		{
			if ($key & $links_enabled)
			{
				$template_vars['S_MENULINKS_' . $value] = true;
			}
		}

		$this->template->assign_vars($template_vars);
		return $this;
	}

	/*
	 * @return self
	 */
	public function assign_acp_select_template_vars():self
	{
		$links_enabled = $this->config['menulinks_links'];

		$this->template->assign_var('S_MENULINKS_REPO_LINK', $links_enabled & 1 ? true : false);
	
		$links = $this->links;

		unset($links[1]);

		foreach ($links as $key => $value)
		{
			$this->template->assign_block_vars('links', [
				'VALUE'			=> $key,
				'S_SELECTED'	=> ($key & $links_enabled) ? true : false,
				'LANG'			=> $this->language->lang('ACP_MENULINKS_' . $value),
			]);
		}
		return $this;
	}

	/*
	 * @param array		$links
	 * @param int		$repo_link
	 * @return self
	 */
	public function set(array $links, int $menulinks_repo_link):self
	{
		$this->config->set('menulinks_links', array_sum($links) + $menulinks_repo_link);
		return $this;
	}
}
