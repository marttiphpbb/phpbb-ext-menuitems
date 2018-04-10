<?php
/**
* phpBB Extension - marttiphpbb menuitems
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\menuitems\acp;

class main_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $template, $request;
		global $config, $phpbb_root_path;
		global $phpbb_container;

		$language = $phpbb_container->get('language');
		$language->add_lang('acp', 'marttiphpbb/menuitems');
		add_form_key('marttiphpbb/menuitems');

		switch($mode)
		{
			case 'links':

				$links = $phpbb_container->get('marttiphpbb.menuitems.render.links');

				$this->tpl_name = 'links';
				$this->page_title = $language->lang('ACP_MARTTIPHPBB_MENUITEMS_LINKS');

				if ($request->is_set_post('submit'))
				{
					if (!check_form_key('marttiphpbb/menuitems'))
					{
						trigger_error('FORM_INVALID');
					}

					$links->set($request->variable('links', [0 => 0]), $request->variable('menuitems_repo_link', 0));

					trigger_error($language->lang('ACP_MARTTIPHPBB_MENUITEMS_SETTING_SAVED') . adm_back_link($this->u_action));
				}

				$links->assign_acp_select_template_vars();

				break;
		}

		$template->assign_var('U_ACTION', $this->u_action);
	}
}
