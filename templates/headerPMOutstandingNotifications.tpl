<div class="info deletable" id="pmOutstandingNotifications">
	<a href="index.php?page=PM&amp;action=disableNotifications&amp;t={@SECURITY_TOKEN}{@SID_ARG_2ND}" class="close deleteButton"><img src="{icon}closeS.png{/icon}" alt="" title="{lang}wcf.pm.notification.cancel{/lang}" longdesc="" /></a>
	<p>{lang}wsip.pm.notification.report{/lang}</p>
	<ul>
		{foreach from=$outstandingNotifications item=outstandingNotification}
			<li title="{$outstandingNotification->getMessagePreview()}">
				<a href="index.php?page=PMView&amp;pmID={@$outstandingNotification->pmID}{@SID_ARG_2ND}#pm{@$outstandingNotification->pmID}">{$outstandingNotification->subject}</a>
				{lang}wcf.pm.messageFrom{/lang}

				{if $outstandingNotification->userID}
					<a href="index.php?page=User&amp;userID={@$outstandingNotification->userID}{@SID_ARG_2ND}">{$outstandingNotification->username}</a>
				{elseif $outstandingNotification->username}
					{$outstandingNotification->username}
				{else}
					{lang}wcf.pm.author.system{/lang}
				{/if}
			</li>
		{/foreach}
	</ul>
</div>