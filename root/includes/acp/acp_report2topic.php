<?php
/**
 *
 * @package report2topic++
 * @copyright (c) 2010 report2topic++ http://github.com/report2topic
 * @author Erik Frèrejean ( N/A ) http://www.erikfrerejean.nl
 * @author David King (imkingdavid) http://www.phpbbdevelopers.net
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

class acp_report2topic
{
	public $u_action;

	/**
	 * @var report2topic_core The report2topic_core object
	 */
	private $core = null;

	/**
	 * @var String The form key used for this page
	 */
	private $form_key = '';

	/**
	 * @var Boolean A form submitted or not
	 */
	private $submit = false;

	/**
	 * Load the module
	 * @param	String $id		Module ID
	 * @param	String $mode	Module mode
	 * @return	void
	 */
	public function main($id, $mode)
	{
		// Collect some common vars
		$this->submit = (isset($_POST['submit'])) ? true : false;

		// Set the core
		$this->core = report2topic_core::getInstance();

		// Do the right page
		if (method_exists($this, '_' . $mode))
		{
			call_user_func(array($this, '_' . $mode));
		}

		add_form_key($this->form_key);

		// Inform the template on which acp page the user is
		$this->core->template->assign_var('ON_R2T_ACP_PAGE', '_' . $mode);
	}

	/**
	 * Main report2topic++ configuration
	 * @todo	Destination forum should be made more flexible. A forum should
	 * 			be able to define which forum shall be used for the reports. This
	 * 			is only for development atm.
	 * @return void
	 */
	private function _config()
	{
		// Setup the page
		$this->tpl_name		= 'mods/report2topic++/report2topic++';
		$this->page_title	= 'ACP_REPORT2TOPIC_CONFIG';
		$this->form_key		= 'report2topic++_config';

		// Submit
		if ($this->submit)
		{
			// Get teh vars
			$dest_forum		= request_var('report2topic_post_forum', 0);
			$pm_dest_forum	= request_var('report2topic_pm_forum', 0);
			$pm_title		= utf8_normalize_nfc(request_var('report2topic_pm_title', '', true));
			$post_title		= utf8_normalize_nfc(request_var('report2topic_post_title', '', true));
			$pm_template	= utf8_normalize_nfc(request_var('report2topic_pm_template', '', true));
			$post_template	= utf8_normalize_nfc(request_var('report2topic_post_template', '', true));

			// Teh option checkboxes
			$pm_template_bbcode		= (isset($_POST['report2topic_pm_template_parse_bbcode'])) ? true : false;;
			$pm_template_smilies	= (isset($_POST['report2topic_pm_template_parse_bbcode'])) ? true : false;
			$pm_template_urls		= (isset($_POST['report2topic_pm_template_parse_urls'])) ? true : false;
			$pm_template_sig		= (isset($_POST['report2topic_pm_template_parse_sig'])) ? true : false;
			$post_template_bbcode	= (isset($_POST['report2topic_post_template_parse_bbcode'])) ? true : false;
			$post_template_smilies	= (isset($_POST['report2topic_post_template_parse_smilies'])) ? true : false;
			$post_template_urls		= (isset($_POST['report2topic_post_template_parse_urls'])) ? true : false;
			$post_template_sig		= (isset($_POST['report2topic_post_template_parse_sig'])) ? true : false;

			// Validate the forum IDs
			// If valid save the settings.
			$sql = 'SELECT forum_id
				FROM ' . FORUMS_TABLE . '
				WHERE ' . $this->core->db->sql_in_set('forum_id', array($dest_forum, $pm_dest_forum));
			$result	= $this->core->db->sql_query($sql);
			while ($forum = $this->core->db->sql_fetchrow($result))
			{
				if ($forum['forum_id'] == $dest_forum)
				{
					set_config('r2t_dest_forum', $dest_forum);
				}

				if ($forum['forum_id'] == $pm_dest_forum)
				{
					set_config('r2t_pm_dest_forum', $pm_dest_forum);
				}
			}
			$this->core->db->sql_freeresult($result);

			// Save topic title
			set_config('r2t_pm_title', $pm_title);
			set_config('r2t_post_title', $post_title);

			// Save the templates
			set_config('r2t_pm_template', $pm_template);
			set_config('r2t_post_template', $post_template);

			// Save all the options
			set_config('r2t_pm_template_bbcode', $pm_template_bbcode);
			set_config('r2t_pm_template_smilies', $pm_template_smilies);
			set_config('r2t_pm_template_urls', $pm_template_urls);
			set_config('r2t_pm_template_sig', $pm_template_sig);
			set_config('r2t_post_template_bbcode', $post_template_bbcode);
			set_config('r2t_post_template_smilies', $post_template_smilies);
			set_config('r2t_post_template_urls', $post_template_urls);
			set_config('r2t_post_template_sig', $post_template_sig);

			trigger_error($this->core->user->lang('ACP_REPORT2TOPIC_CONFIG_SUCCESS') . adm_back_link($this->u_action));
		}

		$dest_forum_id		= (isset($this->core->config['r2t_dest_forum'])) ? $this->core->config['r2t_dest_forum'] : 0;
		$pm_dest_forum_id	= (isset($this->core->config['r2t_pm_dest_forum'])) ? $this->core->config['r2t_pm_dest_forum'] : 0;

		// Output the page
		$this->core->template->assign_vars(array(
			'S_DEST_OPTIONS'	=> make_forum_select($dest_forum_id, false, true, true),
			'S_PM_DEST_OPTIONS'	=> make_forum_select($pm_dest_forum_id, false, true, true),
			'S_PM_TEMPLATE'		=> (isset($this->core->config['r2t_pm_template'])) ? $this->core->config['r2t_pm_template'] : '',
			'S_PM_TITLE'		=> (isset($this->core->config['r2t_pm_title'])) ? $this->core->config['r2t_pm_title'] : '',
			'S_POST_TEMPLATE'	=> (isset($this->core->config['r2t_post_template'])) ? $this->core->config['r2t_post_template'] : '',
			'S_PM_TEMPLATE_BBCODE_CHECKED'		=> (isset($this->core->config['r2t_pm_template_bbcode'])) ? $this->core->config['r2t_pm_template_bbcode'] : false,
			'S_PM_TEMPLATE_SMILIES_CHECKED'		=> (isset($this->core->config['r2t_pm_template_smilies'])) ? $this->core->config['r2t_pm_template_smilies'] : false,
			'S_PM_TEMPLATE_URLS_CHECKED'		=> (isset($this->core->config['r2t_pm_template_urls'])) ? $this->core->config['r2t_pm_template_urls'] : false,
			'S_PM_TEMPLATE_SIG_CHECKED'			=> (isset($this->core->config['r2t_pm_template_sig'])) ? $this->core->config['r2t_pm_template_sig'] : false,
			'S_POST_TEMPLATE_BBCODE_CHECKED'	=> (isset($this->core->config['r2t_post_template_bbcode'])) ? $this->core->config['r2t_post_template_bbcode'] : false,
			'S_POST_TEMPLATE_SMILIES_CHECKED'	=> (isset($this->core->config['r2t_post_template_smilies'])) ? $this->core->config['r2t_post_template_smilies'] : false,
			'S_POST_TEMPLATE_URLS_CHECKED'		=> (isset($this->core->config['r2t_post_template_urls'])) ? $this->core->config['r2t_post_template_urls'] : false,
			'S_POST_TEMPLATE_SIG_CHECKED'		=> (isset($this->core->config['r2t_post_template_sig'])) ? $this->core->config['r2t_post_template_sig'] : false,
			'S_POST_TITLE'		=> (isset($this->core->config['r2t_post_title'])) ? $this->core->config['r2t_post_title'] : '',

			'U_ACTION'	=> $this->u_action,
		));

		// Add tokens
		foreach ($this->core->user->lang['r2t_tokens'] as $token => $explain)
		{
			$this->core->template->assign_block_vars('token', array(
				'TOKEN'		=> '{' . $token . '}',
				'EXPLAIN'	=> $explain,
			));
		}
	}

	/**
	 * Quick resolution ACP page
	 * @return void
	 */
	private function _quick_resolution()
	{
		// Setup the page
		$this->tpl_name		= 'mods/report2topic++/report2topic++';
		$this->page_title	= 'ACP_REPORT2TOPIC_QUICKRESOLUTION';
		$this->form_key		= 'report2topic++_quick_resolution';

		// Build the configuration array for this page
		// Only supports radio buttons and if required for a setting an additional text box
		$_r2t_config = array(
			array(
				'name'				=> 'r2t_close_report',
				'selected_yes'		=> (isset($this->core->config['r2t_close_report'])) ? $this->core->config['r2t_close_report'] : false,
			),
			array(
				'name'				=> 'r2t_view_report',
				'selected_yes'		=> (isset($this->core->config['r2t_view_report'])) ? $this->core->config['r2t_view_report'] : false,
			),
			array(
				'name'				=> 'r2t_delete_reported_post',
				'selected_yes'		=> (isset($this->core->config['r2t_delete_reported_post'])) ? $this->core->config['r2t_delete_reported_post'] : false,
			),
			array(
				'name'				=> 'r2t_delete_reported_topic',
				'selected_yes'		=> (isset($this->core->config['r2t_delete_reported_topic'])) ? $this->core->config['r2t_delete_reported_topic'] : false,
			),
			array(
				'name'				=> 'r2t_move_topic',
				'selected_yes'		=> (isset($this->core->config['r2t_move_topic'])) ? $this->core->config['r2t_move_topic'] : false,
				'text_box_name'		=> 'r2t_move_topic_dest',
				'text_box_value'	=> (isset($this->core->config['r2t_move_topic_dest'])) ? $this->core->config['r2t_move_topic_dest'] : false,
			),
			array(
				'name'				=> 'r2t_split_move_post',
				'selected_yes'		=> (isset($this->core->config['r2t_split_move_post'])) ? $this->core->config['r2t_split_move_post'] : false,
				'text_box_name'		=> 'r2t_move_post_dest',
				'text_box_value'	=> (isset($this->core->config['r2t_move_post_dest'])) ? $this->core->config['r2t_move_post_dest'] : false,
			),
		);

		// Build the boxes
		foreach ($_r2t_config as $config_row)
		{
			// radio buttons
			$_tpl_row = array(
				'CONFIG_NAME'			=> $config_row['name'],
				'L_CONFIG_NAME'			=> $this->core->user->lang('R2T_CONFIG_' . strtoupper($config_row['name'])),
				'L_CONFIG_NAME_EXPLAIN'	=> (isset($this->core->user->lang['R2T_CONFIG_' . strtoupper($config_row['name']) . '_EXPLAIN'])) ? $this->core->user->lang['R2T_CONFIG_' . strtoupper($config_row['name']) . '_EXPLAIN'] : '',
				'S_YES_CHECKED'			=> $config_row['selected_yes'],
			);

			// Text box?
			if (isset($config_row['text_box_name']))
			{
				$_tpl_row = array_merge($_tpl_row, array(
					'CONFIG_TEXT_CONFIG_NAME'		=> $config_row['text_box_name'],
					'L_CONFIG_ADD_SETTING_VALUE'	=> $config_row['text_box_value'],
				));
			}

			$this->core->template->assign_block_vars('r2t_qr_settings', $_tpl_row);
		}

		// Output the page
		$this->core->template->assign_vars(array(
			'U_ACTION'	=> $this->u_action,
		));


	}
}