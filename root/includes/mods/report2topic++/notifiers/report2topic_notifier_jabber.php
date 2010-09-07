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

if (!class_exists('report2topic_notifier_base'))
{
	require PHPBB_ROOT_PATH . 'includes/mods/report2topic_notifier_base.' . PHP_EXT;
}

/**
 * Jabber notifier class. This notifier sends out
 * a Jabber message when a new report is made
 *
 * @package report2topic++
 */
class report2topic_notifier_jabber extends report2topic_notifier_base
{
	/**
	 * Send the notification
	 */
	public function send()
	{
	}
}