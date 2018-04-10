<?php

/**
* phpBB Extension - marttiphpbb menuitems
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …

$lang = array_merge($lang, [

	'ACP_MARTTIPHPBB_MENUITEMS_SETTING_SAVED'						=> 'Settings have been saved successfully!',

// rendering: links
	'ACP_MARTTIPHPBB_MENUITEMS_ITEMS'								=> 'Menu items',
	'ACP_MARTTIPHPBB_MENUITEMS_ITEM_LOCATIONS' 						=> 'Menu item locations',

	'ACP_MARTTIPHPBB_MENUITEMS_OVERALL_HEADER_NAVIGATION_PREPEND'	=> 'Overall header navigation prepend',
	'ACP_MARTTIPHPBB_MENUITEMS_OVERALL_HEADER_NAVIGATION_APPEND'	=> 'Overall header navigation append',
	'ACP_MARTTIPHPBB_MENUITEMS_NAVBAR_HEADER_QUICK_LINKS_BEFORE'	=> 'Navbar header quick links before',
	'ACP_MARTTIPHPBB_MENUITEMS_NAVBAR_HEADER_QUICK_LINKS_AFTER'		=> 'Navbar header quick links after',
	'ACP_MARTTIPHPBB_MENUITEMS_OVERALL_HEADER_BREADCRUMBS_BEFORE'	=> 'Overall header breadcrumbs before',
	'ACP_MARTTIPHPBB_MENUITEMS_OVERALL_HEADER_BREADCRUMBS_AFTER'	=> 'Overall header breadcrumbs after',
	'ACP_MARTTIPHPBB_MENUITEMS_OVERALL_FOOTER_TIMEZONE_BEFORE'		=> 'Overall footer timezone before',
	'ACP_MARTTIPHPBB_MENUITEMS_OVERALL_FOOTER_TIMEZONE_AFTER'		=> 'Overall footer timezone after',
	'ACP_MARTTIPHPBB_MENUITEMS_OVERALL_FOOTER_TEAMLINK_BEFORE'		=> 'Overall footer teamlink before',
	'ACP_MARTTIPHPBB_MENUITEMS_OVERALL_FOOTER_TEAMLINK_AFTER'		=> 'Overall footer teamlink after',

]);
