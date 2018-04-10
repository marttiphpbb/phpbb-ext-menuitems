<?php
/**
* phpBB Extension - marttiphpbb menuitems
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menuitems\event;

use phpbb\event\data as event;

use marttiphpbb\menuitems\service\menuitems_dispatcher;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var menuitems_dispatcher */
	protected $menuitems_dispatcher;

	/**
	* @param menuitems_dispatcher	$menuitems_dispatcher
	*/
	public function __construct(menuitems_dispatcher $menuitems_dispatcher)
	{
		$this->menuitems_dispatcher = $menuitems_dispatcher;
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
		$context['marttiphpbb_menuitems_links'] = $this->menuitems_dispatcher->get_all();
		$event['context'] = $context;		
	}
}
