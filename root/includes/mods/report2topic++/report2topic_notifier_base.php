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

if (!interface_exists('report2topic_notifier_interface'))
{
	require PHPBB_ROOT_PATH . 'includes/mods/report2topic_notifier_interface.' . PHP_EXT;
}

/**
 * Notifier base class. Provides sensible defaults for notifiers
 * and partially implements the notifier interface,
 * making writing notifiers easier.
 *
 * At a minimum, subclasses must override the send() method.
 *
 * @package report2topic++
 */
abstract class report2topic_notifier_base implements report2topic_notifier_interface
{
	/**
	 * Setup the notifier, $data holds all information required to
	 * successfully send the notification.
	 * @param	Array	$data	All required data to send out this notification.
	 */
	public function setup($data)
	{
		$this->data = $data;
	}
}