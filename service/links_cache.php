<?php

/**
* phpBB Extension - marttiphpbb menuitems
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menuitems\service;

use phpbb\cache\driver\driver_interface as cache;
use phpbb\config\db_text as config_text;

class links_cache
{
	const LOCATION = '_marttiphpbb_menuitems_links';
	const CONFIG_TEXT = 'marttiphpbb_menuitems_links';

	/** @var cache */
	private $cache;

	/** @var config_text */
	private $config_text;
	
	/** @var array */
	private $events = [];

	public function __construct(cache $cache, config_text $config_text)
	{
		$this->cache = $cache;
		$this->config_text = $config_text;			
	}

	private function load()
	{
		$this->links = $this->cache->get(self::LOCATION);
		
		if ($this->links)
		{
			return;
		}
		
		$this->refresh();
	}

	public function refresh()
	{
		$this->links = unserialize($this->config_text->get(self::CONFIG_TEXT));
		$this->cache->put(self::LOCATION, $this->links);		
	}

	public function write(array $links)
	{
		$this->cache->put(self::LOCATION, $links);
		$this->config_text->set(self::CONFIG_TEXT, serialize($links));
		$this->links = $links;
	}

	public function set(string $extension_name, string $key, int $link_locations)
	{
		if (!$this->links)
		{
			$this->load();
		}

		$links = $this->links;

		$links[$extension_name][$key] = $link_locations;

		$this->write($links);
	}

	public function get(string $extension_name, string $key):int
	{
		if (!$this->links)
		{
			$this->load();
		}

		return $this->links[$extension_name][$key] ?? 0;
	}

	public function get_extensions():array 
	{
		if (!$this->links)
		{
			$this->load();
		}

		return array_keys($this->links);
	}

	public function erase_extension(string $extension_name)
	{
		if (!$this->links)
		{
			$this->load();
		}

		$links = $this->links;

		unset($links[$extension_name]);

		$this->write($links);
	}
}
