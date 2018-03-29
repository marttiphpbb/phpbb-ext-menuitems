<?php
/**
* phpBB Extension - marttiphpbb menulinks
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menulinks\event;

use phpbb\event\data as event;

use marttiphpbb\menulinks\service\links;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/* @var links */
	protected $links;

	/**
	* @param links	$links
	*/
	public function __construct(links $links)
	{
		$this->links = $links;
	}

	static public function getSubscribedEvents()
	{
		return [
			'core.page_header'	
				=> 'core_page_header',
			'core.twig_environment_render_template_before'
				=> 'core_twig_environment_render_template_before',
		];
	}

	public function core_page_header(event $event)
	{
		$this->links->trigger_event();
	}

	public function core_twig_environment_render_template_before(event $event)
	{
		$context = $event['context'];
		$context['marttiphpbb_menulinks_links'] = $this->links->get_all();
		$event['context'] = $context;		
	}
}
