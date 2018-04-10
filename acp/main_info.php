<?php
/**
* phpBB Extension - marttiphpbb menuitems
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menuitems\acp;

class main_info
{
	function module()
	{
		return [
			'filename'	=> '\marttiphpbb\menuitems\acp\main_module',
			'title'		=> 'ACP_MENUITEMS',
			'modes'		=> [
				'links'	=> [
					'title' => 'ACP_MENUITEMS_LINKS',
					'auth' => 'ext_marttiphpbb/menuitems && acl_a_board',
					'cat' => ['ACP_MENUITEMS'],
				],
			],
		];
	}
}
