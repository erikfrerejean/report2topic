<?php
/**
 *
 * report2topic++_install [English]
 *
 * @package language
 * @copyright (c) 2010 report2topic++ http://github.com/report2topic
 * @author Erik Frèrejean ( N/A ) http://www.erikfrerejean.nl
 * @author David King (imkingdavid) http://www.phpbbdevelopers.net
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
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
//

$lang = array_merge($lang, array(
	'INSTALL_REPORT2TOPIC++'			=> 'Install report2topic++',
	'INSTALL_REPORT2TOPIC++_CONFIRM'	=> 'Do you really want to install report2topic++?',
	'UPDATE_REPORT2TOPIC++'				=> 'Update report2topic++',
	'UPDATE_REPORT2TOPIC++_CONFIRM'		=> 'Do you really want to update report2topic++?',
	'UNINSTALL_REPORT2TOPIC++'			=> 'Remove report2topic++',
	'UNINSTALL_REPORT2TOPIC++_CONFIRM'	=> 'Do you really want to remove report2topic++?',
));