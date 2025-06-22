<?php if($slug == 'activatekey') { ?>
<div class="page-vip">
	<h1>Activate your VIP Key</h1>
    <p><span>You can Enable your VIP Access by activating your <a href="/donate">VIP Key</a> here:</span></p>
    <p class="text-muted">You only have to activate your VIP Key once.<br /><span>Your VIP Login Credentials will be emailed to you after you've activated your VIP Key.</span>
    </p>
    <p class="text-info">Make sure that the email address you fill in below is correct.<br />Please double-check!</p>
	<form data-ajax="true" action="/json/activatekey" data-captcha="activatekey" class="form">
		<div class="mdb-form">
			<label>Paste your new VIP Key:</label>
			<input type="text" required class="mdb-input" name="vipkey">
		</div>
		<div class="mdb-form">
			<label>Your email address:</label>
			<input type="email" required class="mdb-input" name="email">
		</div>
		<div class="mdb-form">
			<label>Confirm email address:</label>
			<input type="email" required class="mdb-input" autocomplete="nope" name="email_confirm">
		</div>
		<div class="mdb-form">
			<button type="submit" class="mdb-btn mdb-theme mdb-block"><span class="fa fa-key goldc"></span> Activate VIP Key</button>
		</div>
	</form>
    <p class="text-muted"><span class="fa fa-info-circle"></span> Your VIP Key should look something like: <em style="color:#6c757d"> AbC1ExAmPlEkEy2DeF</em><br />If you already have an active VIP Account, then the days from your new Key will be added to your remaining days.<br /><span>Once logged in as VIP, the date until your VIP Access is active is shown all the way at the bottom of each page.</span><br />Please contact <strong><?=$setting['email']?></strong> if there are any issues.</p>
</div>
<?php } else { ?>
<div class="page-vip">
	Update...
<?php } ?>