<?php
/**
* phpBB Extension - marttiphpbb calendar
* @copyright (c) 2014 - 2016 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\calendar\model;

use phpbb\config\config;
use phpbb\template\template;
use phpbb\language\language;

class render_settings
{

	/* @var config */
	protected $config;

	/* @var template */
	protected $template;

	/* @var language */
	protected $language;

	protected $render_settings = array(
		1		=> 'ISOWEEK',
		2		=> 'MOONPHASE',
		4		=> 'TODAY',
	);

	/**
	* @param config		$config
	* @param template	$template
	* @param language		$language
	* @return render_settings
	*/
	public function __construct(
		config $config,
		template $template,
		language $language
	)
	{
		$this->config = $config;
		$this->template = $template;
		$this->language = $language;
	}

	/*
	 * @return render_settings
	 */
	public function assign_template_vars()
	{
		$render_settings = $this->config['calendar_render_settings'];
		$template_vars = array();

		foreach ($this->render_settings as $key => $value)
		{
			if ($key & $render_settings)
			{
				$template_vars['S_' . $value] = true;
			}
		}

		$this->template->assign_vars($template_vars);
		return $this;
	}

	/*
	 * @return render_settings
	 */
	public function assign_acp_template_vars()
	{
		$render_settings = $this->config['calendar_render_settings'];

		foreach ($this->render_settings as $key => $value)
		{
			$explain_key = 'ACP_CALENDAR_' . $value . '_EXPLAIN';
			$explain = (isset($this->language->lang[$explain_key])) ? $this->language->lang[$explain_key] : '';

			$this->template->assign_block_vars('render_settings', array(
				'VALUE'			=> $key,
				'S_CHECKED'		=> ($key & $render_settings) ? true : false,
				'LABEL'			=> $this->language->lang('ACP_CALENDAR_' . $value),
				'EXPLAIN'		=> $explain,
			));
		}
		return $this;
	}

	/*
	 * @param array		$render_settings
	 * @param int		$repo_link
	 * @return links
	 */
	public function set($render_settings)
	{
		$this->config->set('calendar_render_settings', array_sum($render_settings));
		return $this;
	}
}
