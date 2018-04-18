<?php
/**
* phpBB Extension - marttiphpbb menuitems
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menuitems\event;

use phpbb\event\data as event;

use marttiphpbb\menuitems\service\menuitems_dispatcher;
use marttiphpbb\menuitems\service\menuitems_store;
use marttiphpbb\menuitems\service\acp;
use phpbb\template\template;

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
	private $menuitems_dispatcher;

	/** @var menuitems_store */
	private $menuitems_store;

	/** @var acp */
	private $acp;

	/**
	* @param menuitems_dispatcher
	* @param menuitems_store 
	* @param acp
	*/
	public function __construct(
		menuitems_dispatcher $menuitems_dispatcher, 
		menuitems_store $menuitems_store,
		acp $acp
	)
	{
		$this->menuitems_dispatcher = $menuitems_dispatcher;
		$this->menuitems_store = $menuitems_store;
		$this->acp = $acp;
	}

	static public function getSubscribedEvents()
	{
		return [		
			'core.acp_extensions_run_action_after'
				=> 'core_acp_extensions_run_action_after',
			'core.page_header'	
				=> 'core_page_header',
			'core.twig_environment_render_template_before'
				=> 'core_twig_environment_render_template_before',
		];
	}

	public function core_acp_extensions_run_action_after(event $event)
	{
		if ($event['action'] === 'delete_data')
		{
			$this->menuitems_store->remove_extension($event['ext_name']);
		}
	}

	public function core_page_header(event $event)
	{
		$this->menuitems_dispatcher->trigger_event();
	}

	public function core_twig_environment_render_template_before(event $event)
	{
		$context = $event['context'];
		$context['marttiphpbb_menuitems'] = [
			'items'		=> $this->menuitems_dispatcher->get_items(),
			'acp'		=> $this->acp->get_selected(),
		];
		$event['context'] = $context;	
	}
}
