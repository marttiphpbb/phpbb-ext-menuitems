<?php

/**
* phpBB Extension - marttiphpbb menulinks
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menulinks\service;

use phpbb\event\dispatcher;

class links_dispatcher
{
	/** @var dispatcher */
	private $dispatcher;

	/** @var array */
	private $links = [];

	/**
	 * @param dispatcher $dispatcher
	*/
	public function __construct(dispatcher $dispatcher)
	{
		$this->dispatcher = $dispatcher;
	}

	/**
	 * @param array 
	 */
	public function trigger_event()
	{	
		$items = [];
	
		/**
		 * To set menu links 
		 *
		 * @event 
		 * @var array	links  push here your links 
		 *
		 */
		$vars = ['links'];
		$result = $this->dispatcher->trigger_event('marttiphpbb.menulinks.set_items', compact($vars));

		if (count($result['items']))
		{
			$this->links[] = $result['links'];
		}
	}

	/**
	 * @return array
	 */
	public function get_all():array
	{
		return $this->items;
	}
}
