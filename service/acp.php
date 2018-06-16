<?php

/**
* phpBB Extension - marttiphpbb menuitems
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menuitems\service;

use marttiphpbb\menuitems\service\menuitems_store;
use phpbb\request\request;
use phpbb\language\language;

class acp
{
	protected $menuitems_store;
	protected $request;
	protected $language;
	protected $selected = [];

	public function __construct(menuitems_store $menuitems_store, request $request, language $language)
	{
		$this->menuitems_store = $menuitems_store;
		$this->request = $request;
		$this->language = $language;
	}

	public function process_form(string $extension_name, string $key)
	{
		if (!$this->request->is_set_post('submit'))
		{
			return;
		}

		$items = $this->request->variable('marttiphpbb_menuitems', ['' => ['' => '']]);

		$this->menuitems_store->set($extension_name, $key, $items[$key] ?? []);
	}

	public function assign_to_template(string $extension_name)
	{
		$this->selected = $this->menuitems_store->get_all()[$extension_name] ?? [];
		$this->language->add_lang('acp', 'marttiphpbb/menuitems');
	}

	public function get_selected():array
	{
		return $this->selected;
	}
}
