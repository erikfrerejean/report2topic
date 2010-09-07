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

/**
 * report2topic++ notifier interface
 * @package phpBB3
 */
interface report2topic_notifier_interface
{
	/**
	 * Send the notification
	 */
	public function send();

	/**
	 * Setup the notifier, $data holds all information required to
	 * successfully send the notification.
	 * @param	Array	$data	All required data to send out this notification.
	 */
	public function setup($data);
}