<?php if ($slug == 'activatehash') { ?>
	<div class="page-vip profile">
		<h1>Create a new password</h1>
		<p>Username: <span class="text-muted"><?= $arr['name'] ?></span></p>
		<p>Email: <span class="text-muted"><?= $arr['email'] ?></span></p>
		<form data-ajax="true" action="/json/activatehash" class="form">
			<input type="hidden" required class="form-control" value="<?= $hash ?>" name="hash">
			<div class="form-group">
				<label>New password:</label>
				<input type="password" required class="form-control" autocomplete="nope" name="password">
			</div>
			<div class="form-group">
				<label>Confirm password:</label>
				<input type="password" required class="form-control" autocomplete="nope" name="password_confirm">
			</div>
			<div class="form-group">
				<button type="submit" class="mdb-btn mdb-theme mdb-block"><span class="fa fa-key goldc"></span> Change password</button>
			</div>
		</form>
	</div>
<?php } elseif ($slug == 'profile') { ?>
	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<h1><?= $__l['pf.t'] ?></h1>
				<p><?= $__l['yname'] ?>: <strong class="text-bold btn-block"><?= $_SESSION['uname'] ?></strong></p>
				<p><?= $__l['email'] ?>: <strong class="text-bold btn-block"><?= $_SESSION['umail'] ?></strong></p>
				<form data-submit="password" data-captcha="password" class="form">
					<div class="form-group">
						<label><?= $__l['pwd'] ?>:</label>
						<input type="password" required class="form-control" autocomplete="nope" name="password">
					</div>
					<div class="form-group">
						<label><?= $__l['pwd.n'] ?>:</label>
						<input type="password" required class="form-control" autocomplete="nope" name="password_new">
					</div>
					<div class="form-group">
						<label><?= $__l['pwd.c'] ?>:</label>
						<input type="password" required class="form-control" autocomplete="nope" name="password_confirm">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary"><span class="fa fa-key goldc"></span> <?= $__l['pwd.change'] ?></button>
					</div>
				</form>
			</div>
			<div class="col-md-3"></div>
		</div>

	</div>
<?php } elseif ($match[1] == 'favorite') { ?>



	<div class="container m30 text-left">
		<section class="block_area block_area_category">
			<div class="block_area-header block_area-header-tabs">
				<h1 class="cat-heading"><?= $__l['fav.t'] ?></h1>
			</div>
			<?php if ($arr['data']) { ?>
				<div class="manga_list-sbs">
					<div class="mls-wrap">
						<?= movies($arr['data']) ?>
						<div class="clearfix"></div>
					</div>
					<div class="pre-pagination mt-4">
						<?= $pages ?>
					</div>
				</div>
			<?php } else { ?>
				<div class="notice"><?= $__l['fav.m'] ?></div>
			<?php } ?>

		</section>
	</div>
<?php } ?>