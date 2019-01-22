<?php

/**
 * phpBB Extension - marttiphpbb menuitems
 * @copyright (c) 2014 - 2019 marttiphpbb <info@martti.be>
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace marttiphpbb\menuitems\service;

use phpbb\config\db_text as config_text;
use phpbb\cache\driver\driver_interface as cache;
use marttiphpbb\menuitems\util\cnst;

class store
{
	protected $config_text;
	protected $cache;
	protected $items = [];
	protected $local_cache;
	protected $transaction = false;

	public function __construct(config_text $config_text, cache $cache)
	{
		$this->config_text = $config_text;
		$this->cache = $cache;
	}

	private function load():void
	{
		if ($this->items) {
			return;
		}

		$this->items = $this->cache->get(cnst::CACHE_ID);

		if ($this->items) {
			return;
		}

		$this->items = unserialize($this->config_text->get(cnst::ID));
		$this->cache->put(cnst::CACHE_ID, $this->items);
	}

	private function write():void
	{
		$this->config_text->set(cnst::ID, serialize($this->items));
		$this->cache->put(cnst::CACHE_ID, $this->items);
	}

	public function transaction_start():void
	{
		$this->transaction = true;
	}

	public function transaction_end():void
	{
		$this->transaction = false;
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

	public function set(string $extension_name, string $key, array $template_events):void
	{
		$this->load();

		if (count($template_events))
		{
			$this->items[$extension_name][$key] = $template_events;
		}
		else
		{
			unset($this->items[$extension_name][$key]);
		}

		if (!$this->transaction)
		{
			$this->write();
		}
	}

	public function remove_key(string $extension_name, string $key):void
	{
		$this->load();
		unset($this->items[$extension_name][$key]);

		if (!$this->transaction)
		{
			$this->write();
		}
	}

	public function remove_extension(string $extension_name):void
	{
		$this->load();
		unset($this->items[$extension_name]);

		if (!$this->transaction)
		{
			$this->write();
		}
	}

	public function get_extensions():array
	{
		$this->load();
		return array_keys($this->items);
	}

	public function extension_is_present(string $extension_name):bool
	{
		$this->load();
		return isset($this->items[$extension_name]);
	}
}
