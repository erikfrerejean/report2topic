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
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
define('IN_INSTALL', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_admin.' . $phpEx);

// Make sure that the hook file is loaded.
if (!class_exists('hook_report2topic'))
{
	require($phpbb_root_path . 'includes/hook/hook_report2topic.' . $phpEx);
}

$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// The name of the mod to be displayed during installation.
$mod_name = 'REPORT2TOPIC++';


// The name of the config variable which will hold the currently installed version
// You do not need to set this yourself, UMIL will handle setting and updating the version itself.
$version_config_name = 'report2topic++_version';


// The language file which will be included when installing
// Language entries that should exist in the language file for UMIL (replace $mod_name with the mod's name you set to $mod_name above)
// $mod_name
// 'INSTALL_' . $mod_name
// 'INSTALL_' . $mod_name . '_CONFIRM'
// 'UPDATE_' . $mod_name
// 'UPDATE_' . $mod_name . '_CONFIRM'
// 'UNINSTALL_' . $mod_name
// 'UNINSTALL_' . $mod_name . '_CONFIRM'
$language_file = 'mods/report2topic++/report2topic_install';

// Construct the versions data. Each new version has its own versions data
// file in install/data/
$versions = array();
$version_files = filelist($phpbb_root_path . 'install/', 'version_files/', 'php');

foreach ($version_files['version_files/'] as $version_file)
{
	require("{$phpbb_root_path}install/version_files/{$version_file}");
}

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

// clear cache
$umil->cache_purge(array(
	array(''),
	array('auth'),
	array('template'),
	array('theme'),
));