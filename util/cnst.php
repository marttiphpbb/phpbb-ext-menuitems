<?php
/**
* phpBB Extension - marttiphpbb menuitems
* @copyright (c) 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menuitems\util;

class cnst
{
	const FOLDER = 'marttiphpbb/menuitems';
	const ID = 'marttiphpbb_menuitems';
	const PREFIX = self::ID . '_';
	const NAME_EN = self::PREFIX . 'en';
	const NAME_PRIORITY = self::PREFIX . 'priority';
	const CACHE_ID = '_' . self::ID;
	const L = 'MARTTIPHPBB_MENUITEMS';
	const L_ACP = 'ACP_' . self::L;
	const L_MCP = 'MCP_' . self::L;
	const TPL = '@' . self::ID . '/';
	const EXT_PATH = 'ext/' . self::FOLDER . '/';

	const ITEMS = [
		'overall_header_navigation_prepend',
		'overall_header_navigation_append',
		'navbar_header_quick_links_before',
		'navbar_header_quick_links_after',
		'overall_header_breadcrumbs_before',
		'overall_header_breadcrumbs_after',
		'overall_footer_timezone_before',
		'overall_footer_timezone_after',
		'overall_footer_teamlink_before',
		'overall_footer_teamlink_after',
	];
}
