<?php
/**
* phpBB Extension - marttiphpbb menulinks
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menulinks\event;

use phpbb\controller\helper;
use phpbb\template\template;
use phpbb\language\language;
use phpbb\event\data as event;

use marttiphpbb\menulinks\render\links;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class main_listener implements EventSubscriberInterface
{
	/* @var helper */
	protected $helper;

	/* @var php_ext */
	protected $php_ext;

	/* @var template */
	protected $template;

	/* @var language */
	protected $language;

	/* @var links */
	protected $links;

	/**
	* @param helper		$helper
	* @param template	$template
	* @param links		$links
	*/
	public function __construct(
		helper $helper,
		string $php_ext,
		template $template,
		language $language,
		links $links
	)
	{
		$this->helper = $helper;
		$this->template = $template;
		$this->links = $links;
	}

	static public function getSubscribedEvents()
	{
		return [
			'core.user_setup'						=> 'core_user_setup',
			'core.page_header'						=> 'core_page_header',
		];
	}

	public function core_user_setup(event $event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name' => 'marttiphpbb/menulinks',
			'lang_set' => 'common',
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function core_page_header(event $event)
	{
		$this->links->assign_template_vars();
		$this->template->assign_vars([
			'U_MENULINKS'			=> $this->helper->route('marttiphpbb_menulinks_defaultview_controller'),
		]);
	}
}
