<?php
/**
 *
 * @package Subject Prefix Installer
 * @copyright (c) 2010 Erik Frèrejean ( erikfrerejean@phpbb.com ) http://www.erikfrerejean.nl
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

if (!is_array($versions))
{
	$versions = array();
}

// The array of versions and actions within each.
// You do not need to order it a specific way (it will be sorted automatically),
// however, you must enter every version, even if no actions are done for it.
//
// You must use correct version numbering.  Unless you know exactly what you can
// use, only use X.X.X (replacing X with an integer).
// The version numbering must otherwise be compatible with the version_compare
// function - http://php.net/manual/en/function.version-compare.php
$versions = array_merge($versions, array(
	'1.0.0-dev'	=> array(
		// Alter the forums table
		'table_column_add' => array(
			array(FORUMS_TABLE, 'r2t_report_forum', array('UINT', '0'))
		),

		'table_index_add' => array(
			array(FORUMS_TABLE, 'r2t_report_forum', 'r2t_report_forum'),
		),

		// Create all the configuration entries
		'config_add' => array(
			/**
			 * @todo Populate with some usefull data
			 */
			array('r2t_dest_forum', 0, false),
			array('r2t_pm_dest_forum', 0, false),
			array('r2t_pm_title', '', false),
			array('r2t_post_title', '', false),
			array('r2t_pm_template', '', false),
			array('r2t_post_template', '', false),

			array('r2t_pm_template_bbcode', true, ''),
			array('r2t_pm_template_smilies', true, ''),
			array('r2t_pm_template_urls', true, ''),
			array('r2t_pm_template_sig', true, ''),
			array('r2t_post_template_bbcode', true, ''),
			array('r2t_post_template_smilies', true, ''),
			array('r2t_post_template_urls', true, ''),
			array('r2t_post_template_sig', true, ''),
		),
	),
));