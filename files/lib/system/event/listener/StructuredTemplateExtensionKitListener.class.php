<?php
// wcf imports
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

/**
 * Shows the personal messages, the group management link in the user panel and the outstanding pm notifications.
 * 
 * @author		Sebastian Oettl , changed by TobiasH
 * @copyright	2009-2010 WCF Solutions <http://www.wcfsolutions.com/index.html>
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.woltlab.community.wsip.extensionKit.lite
 * @subpackage	system.event.listener
 * @category	Infinite Portal
 */
class StructuredTemplateExtensionKitListener implements EventListener {
	/**
	 * @see EventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
		if (WCF::getUser()->userID) {
			// personal messages
			if (MODULE_PM == 1) {
				// user panel
				if (WCF::getUser()->getPermission('user.pm.canUsePm')) {
					WCF::getTPL()->append('additionalUserMenuItems', '<li '.(WCF::getUser()->pmUnreadCount ? ' class="new"' : '').' id="userMenuPm"><a href="index.php?page=PMList'.SID_ARG_2ND.'"><img src="'.StyleManager::getStyle()->getIconPath('pm'.(WCF::getUser()->pmUnreadCount ? 'Full' : 'Empty').'S.png').'" alt="" /> <span>'.WCF::getLanguage()->get('wsip.header.userMenu.pm').(WCF::getUser()->pmUnreadCount ? ' ('.StringUtil::formatInteger(WCF::getUser()->pmUnreadCount).')' : '').'</span></a>'.(WCF::getUser()->pmTotalCount >= WCF::getUser()->getPermission('user.pm.maxPm') ? ' <span class="pmBoxFull">'.WCF::getLanguage()->get('wcf.pm.userMenu.mailboxIsFull').'</span>' : '').'</li>');
				}
				
				// outstanding notifications
				require_once(WCF_DIR.'lib/data/message/pm/PM.class.php');
				$outstandingNotifications = PM::getOutstandingNotifications(WCF::getUser()->userID);
				if (WCF::getUser()->showPmPopup && WCF::getUser()->pmOutstandingNotifications && count($outstandingNotifications) > 0) {
					WCF::getTPL()->assign('outstandingNotifications', $outstandingNotifications);
					WCF::getTPL()->append('userMessages', WCF::getTPL()->fetch('headerPMOutstandingNotifications'));
				}
			}
		}
	}
}
?>