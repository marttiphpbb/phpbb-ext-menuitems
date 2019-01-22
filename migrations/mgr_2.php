<?php
/**
* phpBB Extension - marttiphpbb menuitems
* @copyright (c) 2014 - 2019 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menuitems\migrations;

use marttiphpbb\menuitems\util\cnst;

class mgr_2 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return [
			'\marttiphpbb\menuitems\migrations\mgr_1',
		];
	}

	public function update_data()
	{
		$sql = 'select config_value
			from ' . $this->table_prefix . 'config_text
			where config_name = \'' . cnst::ID . '\'';

		$result = $this->db->sql_query($sql);
		$items = $this->db->sql_fetchfield('config_value');
		$this->db->sql_freeresult($result);
		$items = $items ? unserialize($items) : [];
		$new_items = [];

		foreach ($items as $ext => $link_ary)
		{
			$new_items[$ext] = [];

			foreach ($link_ary as $key => $tpl_ev_ary)
			{
				$new_items[$ext][$key] = [];

				foreach ($tpl_ev_ary as $event_name => $priority)
				{
					if (ctype_digit((string) $event_name))
					{
						/**
						 * The previous version did not contain priority data.
						 * The value ($priority) of the previous version is
						 * actually the template event name and becomes the key.
						 * The value becomes the priority.
						 * We set a default priority of 0 (zero).
 						 */
						$new_items[$ext][$key][$priority] = 0;
						continue;
					}

					$new_items[$ext][$key][$event_name] = $priority;
				}
			}
		}

		return [
			['config_text.update', [cnst::ID, serialize($new_items)]],
		];
	}
}
