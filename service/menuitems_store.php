<?php

/**
* phpBB Extension - marttiphpbb menuitems
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menuitems\service;

use phpbb\config\db_text as config_text;
use phpbb\cache\driver\driver_interface as cache;

class menuitems_store
{
	const KEY = 'marttiphpbb_menuitems';
	const CACHE_KEY = '_' . self::KEY;

	/** @var config_text */
	private $config_text;

	/** @var cache */
	private $cache;
	
	/** @var array */
	private $items = [];

	public function __construct(config_text $config_text, cache $cache)
	{
		$this->config_text = $config_text;	
		$this->cache = $cache;		
	}

	private function load()
	{
		if ($this->items)
		{
			return;
		}

		$this->items = $this->cache->get(self::CACHE_KEY);		
		
		if ($this->items)
		{
			return;
		}
		
		$this->items = unserialize($this->config_text->get(self::KEY));
		$this->cache->put(self::CACHE_KEY, $this->items);
	}

	private function write()
	{
		$this->config_text->set(self::KEY, serialize($this->items));
		$this->cache->put(self::CACHE_KEY, $this->items);
	}

	public function set_all(array $items)
	{
		$this->items = $items;
		$this->write();
	}

	public function get_all():array 
	{
		$this->load();
		return $this->items;
	}

	public function get(string $extension_name, string $key):array
	{
		$this->load();
		return $this->items[$extension_name][$key] ?? [];
	}

	public function set(string $extension_name, string $key, array $template_events)
	{
		$this->load();
		$this->items[$extension_name][$key] = $template_events;
		$this->write();
	}

	public function remove_extension(string $extension_name)
	{
		$this->load();
		unset($this->items[$extension_name]);
		$this->write();
	}

	public function get_extensions():array 
	{
		$this->load();
		return array_keys($this->items);
	}

	public function ext_is_present(string $extension_name)
	{
		$this->load();
		return isset($this->items[$extension_name]);
	}
}
