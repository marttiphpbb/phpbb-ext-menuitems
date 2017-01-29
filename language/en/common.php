<?php

/**
* phpBB Extension - marttiphpbb calendar
* @copyright (c) 2014 - 2017 marttiphpbb <info@martti.be>
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

	'CALENDAR'						=> 'Calendar',
	'CALENDAR_EXTENSION'			=> '%sCalendar%s extension for phpBB',

// viewonline
	'CALENDAR_VIEWING'			=> 'Viewing calendar',

	'CALENDAR_MONTH'			=> 'month',
	'CALENDAR_DAY'				=> 'day',
	'CALENDAR_YEAR'				=> 'year',

// %1$s : context (see below)
	'calendar_format'	=> [
		'MONTH_DAY_YEAR'				=> '%1$s %1$s %2$s, %3$s',
		'MONTH_DAY_YEAR_TIME'			=> '%1$s %2$s, %3$s - %4$s',
		'MONTH_DAY_DAY_YEAR'			=> '%1$s %2$s - %5$s, %3$s',
		'MONTH_DAY_MONTH_DAY_YEAR'		=> '%1$s %2$s - %4$s %5$s, %6$s',
		'MONTH_DAY_YEAR_MONTH_DAY_YEAR'	=> '%1$s %2$s, %3$s - %4$s %5$s, %6$s',
	],
// the format context can be used with multiple calendar events for one topic.

	'CALENDAR_NEW_MOON'				=> 'New moon',
	'CALENDAR_FIRST_QUARTER_MOON'	=> 'First quarter moon',
	'CALENDAR_FULL_MOON'			=> 'Full moon',
	'CALENDAR_THIRD_QUARTER_MOON'	=> 'Third quarter moon',

	'CALENDAR_AT'					=> '@',

	'CALENDAR_ERROR_START_DATE'	=> 'Incorrect event start date',
	'CALENDAR_ERROR_END_DATE'	=> 'Incorrect event end date',
]);
