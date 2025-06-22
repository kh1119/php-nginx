<?php if(($setting['tele'] || $setting['twitter']) && !isset($_COOKIE['notice'])) { ?>
<div id="site-notice">
	<div class="alert alert-dismissible fade show" role="alert">
		<div class="container">
			<button type="button" onclick="$.cookie('notice',1,{path:'/'});" class="close" style="opacity: 1; padding: .75rem" data-dismiss="alert" aria-label="Close">
				<span class="text-white" aria-hidden="true">×</span>
			</button>
			<div class="wia-content">
				<div>
				Follow us on Twitter or join our Facebook Group and stay updated with latest news. For list of mirror link of <?=$host?>, please 
				<a href="/" target="_blank">click here </a>
				</div>
				<div class="mt-2">
					<?php if($setting['twitter']) { ?>
					<a class="btn btn-xs btn-twitter" href="https://twitter.com/intent/follow?original_referer=<?=https('/')?>&amp;ref_src=twsrc%5Etfw&amp;region=follow_link&amp;screen_name=<?=$setting['twitter']?>&amp;tw_p=followbutton"><i class="fab fa-twitter mr-2"></i> Follow <b>@<?=$setting['twitter']?></b></a>
					<?php } ?>
					<?php if($setting['tele']) { ?>
					<a href="<?=$setting['tele']?>" class="btn btn-xs btn-telegram" target="_blank"><i class="fab fa-telegram-plane mr-2"></i>Join our Telegram Group</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>