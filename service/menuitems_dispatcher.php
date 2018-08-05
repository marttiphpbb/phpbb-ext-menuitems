<?php

/**
* phpBB Extension - marttiphpbb menuitems
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menuitems\service;

use phpbb\event\dispatcher;
use marttiphpbb\menuitems\service\menuitems_store;

class menuitems_dispatcher
{
	protected $dispatcher;
	protected $menuitems_store;
	protected $items = [];

	public function __construct(dispatcher $dispatcher, menuitems_store $menuitems_store)
	{
		$this->dispatcher = $dispatcher;
		$this->menuitems_store = $menuitems_store;
	}

	public function trigger_event()
	{
		$items = [];

		/**
		 * To set menu items
		 *
		 * @event
		 * @var array	items  push here your items
		 * like this $items['vendor/extension']['menu_key'] = $item;
		 * where item is
		 * 1.) $item = [
		 * 		'link'		=> '/path/to/your/page',
		 * 		'include'	=> '@vendor_extension/your_include_file.html',
		 * 		'var'		=> [],
		 * ];
		 * "var" is an array or string passed as "var" to
		 * your include file. Also "key" is available in your included file.
		 *
		 * 2.) $item = [
		 * 		'link'		=> '/path/to/your/page',
		 * 		'raw'		=> $raw,
		 * ];
		 * "raw"  is the raw content of your menu link.
		 */
		$vars = ['items'];
		$result = $this->dispatcher->trigger_event('marttiphpbb.menuitems', compact($vars));

		if (count($result['items']))
		{
			foreach ($result['items'] as $ext_name => $menu_ary)
			{
				if (!$this->menuitems_store->ext_is_present($ext_name))
				{
					continue;
				}

				foreach ($menu_ary as $key => $data)
				{
					$template_events = $this->menuitems_store->get($ext_name, $key);

					if (!count($template_events))
					{
						continue;
					}

					$data['key'] = $key;

					foreach ($template_events as $template_event)
					{
						if (isset($this->items[$template_event]))
						{
							$this->items[$template_event][] = $data;
							continue;
						}

						$this->items[$template_event] = [$data];
					}
				}
			}
		}
	}

	/**
	 * @return array
	 */
	public function get_items():array
	{
		return $this->items;
	}
}
