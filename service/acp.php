<?php

/**
* phpBB Extension - marttiphpbb menuitems
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menuitems\service;

use marttiphpbb\menuitems\service\store;
use phpbb\request\request;
use phpbb\language\language;
use marttiphpbb\menuitems\util\cnst;

class acp
{
	protected $store;
	protected $request;
	protected $language;
	protected $selected = [];

	public function __construct(store $store, request $request, language $language)
	{
		$this->store = $store;
		$this->request = $request;
		$this->language = $language;
	}

	public function process_form(string $extension_name, string $key)
	{
		if (!$this->request->is_set_post('submit'))
		{
			return;
		}

		$items = $this->request->variable(cnst::ID, ['' => ['' => '']]);
		$enabled_ary = $this->request->variable(cnst::NAME_EN, ['' => ['' => '']]);
		$priority_ary = $this->request->variable(cnst::PRIORITY_EN, ['' => ['' => 0]]);

		$this->store->set($extension_name, $key, $items[$key] ?? []);
	}

	public function assign_to_template(string $extension_name)
	{
		$this->selected = $this->store->get_all()[$extension_name] ?? [];
		$this->language->add_lang('acp', cnst::FOLDER);
	}

	public function get_selected():array
	{
		return $this->selected;
	}
}
