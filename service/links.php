<?php

/**
* phpBB Extension - marttiphpbb menulinks
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menulinks\service;

use phpbb\event\dispatcher;

class links
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
		$links = [];
	
		/**
		 * To set menu links 
		 *
		 * @event 
		 * @var array	links				push here your links 
		 *
		 */
		$vars = ['links'];
		$result = $this->dispatcher->trigger_event('marttiphpbb.menulinks.set_links', compact($vars));

		if (count($result['links']))
		{
			$this->links[] = $result['links'];
		}
	}

	/**
	 * @return array
	 */
	public function get_all():array
	{
		return $this->links;
	}
}
