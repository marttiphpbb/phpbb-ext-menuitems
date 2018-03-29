<?php
/**
* phpBB Extension - marttiphpbb menulinks
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menulinks\acp;

class main_info
{
	function module()
	{
		return [
			'filename'	=> '\marttiphpbb\menulinks\acp\main_module',
			'title'		=> 'ACP_MENULINKS',
			'modes'		=> [
				'links'	=> [
					'title' => 'ACP_MENULINKS_LINKS',
					'auth' => 'ext_marttiphpbb/menulinks && acl_a_board',
					'cat' => ['ACP_MENULINKS'],
				],
			],
		];
	}
}
