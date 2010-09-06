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

	),
));