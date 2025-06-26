<div id="manga-page">
	<div class="manga-detail">
		<div class="detail-bg"><img src="<?= image($mv['thumb'], 300) ?>" alt="<?= $mv['title'] ?>" /></div>
		<div class="container">
			<div class="main-inner">
				<aside class="content">
					<div class="poster">
						<div><img src="<?= image($mv['thumb'], 300) ?>" alt="<?= $mv['title'] ?>" /></div>
					</div>
					<div class="info">
						<p><?= slugTitle($mv['status']) ?></p>
						<h1><?= $mv['title'] ?></h1>
						<?= (($data['another']) ? '<h6>' . $data['another'] . '</h6>' : '') ?>
						<div class="actions">
							<?php if ($read_url) { ?>
								<a class="btn btn-lg btn-primary readnow" href="<?= $read_url ?>"> <?= $__l['Read.Now'] ?> <i class="fa-solid fa-play fa-xs"></i> </a>
							<?php } ?>
							<span id="favorite-state">
								<a href="#" data-id="<?= $mv['id'] ?>" data-remove="<?= (($_SESSION['__fav'][$mv['id']]) ? 1 : 0) ?>" class="btn btn-lg btn-secondary1 favorite">
									<?= (($_SESSION['__fav'][$mv['id']]) ? '<i class="fas fa-trash"></i>' : '<i class="fas fa-heart"></i>') ?>
								</a>
							</span>
							<span data-toggle="modal" data-target="#md-report" class="btn btn-danger report"><i class="fa fa-flag"></i></span>

						</div>
						<div class="min-info">
							<a href="<?= $res[$mv['type']] ?>"><?= $cftps[$mv['type']] ?></a>
							<span><i class="fa-regular fa-folder-bookmark"></i> <?= number_format($mv['view']) ?></span>
						</div>
						<?php if ($data['info']) { ?>
							<div class="description">
								<?= (($setting['vinfo']) ? str_replace(['[title]', '[year]'], [$mv['title'], date("Y")], $setting['vinfo']) . '<br>' : '') ?>
								<?= un_htmlchars($data['info']) ?>
							</div>
							<a class="readmore" data-toggle="modal" href="#synopsis"><?= $__l['more'] ?> +</a>
						<?php } ?>
						<div class="sharethis-inline-share-buttons mt-3 text-center text-md-left"></div>
					</div>
					<button id="info-rating-btn" class="btn" type="button" data-toggle="collapse" data-target="#info-rating" aria-expanded="false" aria-controls="info-rating">
						<i class="fa-solid fa-circle-info"></i> <span class="mx-2">More information & Rating</span> <i class="fa-solid fa-star"></i>
					</button>
				</aside>
				<aside class="sidebar">
					<div class="collapse" id="info-rating">
						<div class="meta">
							<?= (($data['genre']) ? '<div><span>' . $__l['genre'] . ':</span> ' . get_tags($data['genre'], 'genre', 1) . '</div>' : '') ?>
							<?= (($data['author']) ? '<div><span>' . $__l['author'] . ':</span> ' . get_tags($data['author'], 'author', 1) . '</div>' : '') ?>
							<?= (($data['magazine']) ? '<div><span>' . $__l['magazine'] . ':</span> ' . get_tags($data['magazine'], 'magazine', 1) . '</div>' : '') ?>
							<?= (($data['published']) ? '<div><span>' . $__l['Published'] . ':</span> <span>' . $data['published'] . '</span></div>' : '') ?>
							<?php
							if ($build['pram']) {
								foreach ($build['pram'] as $v) {
									if ($data[$v['name']]) {
										echo '<div><span>' . $v['label'] . ':</span><span>' . $data[$v['name']] . '</span></div>';
									}
								}
							}
							?>
						</div>
						<div class="rating-box">
							<div class="dt-rate" id="vote-info">
								<div id="block-rating" data-ui="like" class="block-rating">
									<div class="rating-result">
										<div class="rr-mark">
											<strong>
												<i class="fas fa-star text-warning mr-2"></i>
												<span data-name="rating"><?= (($mv['rating']) ? $mv['rating'] : 9.5) ?></span>
											</strong>
											<small>(<span data-name="voted"><?= (($mv['voted']) ? $mv['voted'] : 1) ?></span> <?= $__l['voted'] ?>)</small>
										</div>
										<div class="progress">
											<div data-name="bar" class="progress-bar bg-success" role="progressbar" style="width: <?= $mv['bar'] ?>%;" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
									<button data-action="like" data-id="<?= $mv['id'] ?>" class="btn btn-sm btn-vote float-left"><i class="fa fa-thumbs-up mr-2"></i><?= $__l['like'] ?>
									</button>
									<button data-action="dislike" data-id="<?= $mv['id'] ?>" class="btn btn-sm btn-vote float-right"><i class="fa fa-thumbs-down mr-2"></i><?= $__l['dislike'] ?>
									</button>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</div>

</div>
<?= ads('post-1') ?>
<div class="container">
	<div class="main-inner manga-bottom">
		<aside class="content">
			<section class="m-list" id="list-chapter">
				<nav class="chapvol-tab" data-tabs>
					<?php if ($arr['chapters']['chap']) { ?>
						<a href="javascript:;" class="tab active" data-name="chapter"><?= $__l['Chapter'] ?></a>
					<?php } ?>
					<?php if ($arr['chapters']['vol']) { ?>
						<a href="javascript:;" class="tab" data-name="volume"><?= $__l['Volume'] ?></a>
					<?php } ?>
				</nav>

				<?php if ($arr['chapters']['chap']) { ?>
					<div class="tab-content" data-name="chapter">
						<div class="list-menu" id="chapters-list">
							<div class="dropdown responsive chapter-s-lang">
								<button class="btn btn-secondary1" data-toggle="dropdown" data-placeholder="false">
									<i class="fa-solid fa-earth-americas"></i> <?= $__l['Language'] ?>:
									<span></span>
								</button>
								<div class="dropdown-menu">
									<?php
									foreach ($arr['chapters']['chap'] as $lang => $chap) {
										echo '<a class="dropdown-item c-select-lang lang-item" href="javascript:;" data-type="chap" data-code="' . $lang . '">[' . strtoupper($lang) . '] ' . $language[$lang] . ' (' . count($chap) . ' ' . $__l['Chapters'] . ')</a>';
									}
									?>
								</div>
							</div>
							<form class="form-inline search-reading-item-form">
								<input class="form-control search-reading-item" type="text" placeholder="<?= $__l['cfocus'] ?>" />
								<button class="btn" type="submit"><i class="fa-regular fa-magnifying-glass"></i></button>
							</form>
						</div>
						<div class="list-body chapters-list-ul">
							<?php
							foreach ($arr['chapters']['chap'] as $lang => $chap) {
								echo '<ul class="scroll-sm reading-list lang-chapters" style="display:none" id="' . $lang . '-chaps">';
								foreach ($chap as $name => $v) {
									$cur	=	pUrl($mv['slug'] . '/' . $lang . '/chapter-' . $name);
									if ($change[$cur]) {
										$chap_url  =  urls($mv['slug'] . '/' . $lang . '/chapter-' . $name . '-i' . $change[$cur], 'post');
									} else {
										$chap_url  =  urls($mv['slug'] . '/' . $lang . '/chapter-' . $name, 'post');
									}
									echo '
										<li class="item reading-item chapter-item" data-id="' . $v['id'] . '" data-number="' . $name . '">
											<a href="' . $chap_url . '" class="item-link" title="' . $__l['Chapter'] . ' ' . $name . (($v['title']) ? ': ' . $v['title'] : '') . '">
												<span><strong>' . xN($name) . '</strong>' . (($v['title']) ? ': ' . $v['title'] : '') . '</span>
												<span>' .ago($v['created']) . '</span>
											</a>
										</li>
										';
								}
								echo '</ul>';
							}
							?>
						</div>
					</div>
				<?php } ?>
				<?php if ($arr['chapters']['vol']) { ?>
					<div class="tab-content" data-name="volume">
						<div class="list-menu" id="list-vol">
							<div class="dropdown responsive chapter-s-lang">
								<button class="btn btn-secondary1" data-toggle="dropdown" data-placeholder="false">
									<i class="fa-solid fa-earth-americas"></i> <?= $__l['Language'] ?>:
									<span></span>
								</button>
								<div class="dropdown-menu">
									<?php
									foreach ($arr['chapters']['vol'] as $lang => $chap) {
										echo '<a class="dropdown-item c-select-lang lang-item" href="javascript:;" data-type="chap" data-code="' . $lang . '">[' . strtoupper($lang) . '] ' . $language[$lang] . ' (' . count($chap) . ' ' . $__l['Chapters'] . ')</a>';
									}
									?>
								</div>
							</div>
							<form class="form-inline search-reading-item-form">
								<input class="form-control search-reading-item search-reading-item2" type="text" placeholder="<?= $__l['vfocus'] ?>" />
								<button class="btn" type="submit"><i class="fa-regular fa-magnifying-glass"></i></button>
							</form>
						</div>
						<div class="list-body chapters-list-ul">
							<?php
							foreach ($arr['chapters']['vol'] as $lang => $chap) {
								echo '<ul class="scroll-sm reading-list lang-chapters" style="display:none" id="' . $lang . '-vols">';
								foreach ($chap as $name => $v) {
									$chap_url	=	urls($mv['slug'] . '/' . $lang . '/volume-' . $name, 'post');
									echo '
										<li class="item reading-item chapter-item" data-id="' . $v['id'] . '" data-number="' . $name . '">
											<a href="' . $chap_url . '" class="item-link" title="' . $__l['Chapter'] . ' ' . $name . (($v['title']) ? ': ' . $v['title'] : '') . '">
												<span>' . $__l['Volume'] . ' ' . $name . (($v['title']) ? ': ' . $v['title'] : '') . '</span>
												<span>' . ago($v['created']) . '</span>
											</a>
										</li>
										';
								}
								echo '</ul>';
							}
							?>
						</div>
					</div>
				<?php } ?>
			</section>
			<?php if ($setting['comment'] > 0) { ?>
				<section class="default-style">
					<div class="head">
						<h2><?= $__l['comment'] ?></h2>
					</div>
					<div class="body p-4">
						<?php if ($setting['comment'] == 2) { ?>
							<div id="disqus_thread"></div>
							<script>
								var disqus_config = function() {
									this.page.url = '<?= $url ?>';
									this.page.identifier = 'Movies-<?= $mv['id'] ?>';
								};
								(function() {
									var d = document,
										s = d.createElement('script');
									s.src = 'https://<?= $setting['comment_id'] ?>.disqus.com/embed.js';
									s.setAttribute('data-timestamp', +new Date());
									(d.head || d.body).appendChild(s);
								})();
							</script>
						<?php } else { ?>
							<div class="fb-comments" data-href="<?= $url ?>" data-width="100%" data-numposts="5"></div>
							<div id="fb-root"></div>
							<script async defer crossorigin="anonymous" src="//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0" nonce="TwyqvOnA"></script>
						<?php } ?>
					</div>
				</section>
			<?php } ?>
		</aside>
		<aside class="sidebar">
			<?= ads('post-2') ?>
			<section class="m-related default-style">
				<div class="head">
					<h2><?= $__l['tags'] ?></h2>
				</div>
				<div class="tags">
					<?= get_tags($data['tag'], 'tag', 1, '') ?>
					<?= get_tags_title($mv['title'], date("Y"), $setting['tags'], 1, ''); ?>
				</div>
			</section>
			<section class="side-manga default-style">
				<div class="head">
					<h2><?= $__l['rtitle'] ?></h2>
				</div>
				<div class="original card-sm body">
					<?= movies($arr['relate'], 'right') ?>
				</div>
			</section>
		</aside>
	</div>
</div>
<script>
	var movie = {
		id: '<?= $mv['id'] ?>',
		share: 1,
		auto: 0,
		vote_count: '<?= (($mv['vote_count']) ? $mv['vote_count'] : 1) ?>',
	};
</script>
<?php if ($data['info']) { ?>
	<div class="modal fade" id="synopsis">
		<div class="modal-dialog limit-w modal-dialog-centered">
			<div class="modal-content p-4">
				<div class="modal-close" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></div>
				<?= un_htmlchars($data['info']) ?>
			</div>
		</div>
	</div>
<?php } ?>
<div class="modal premodal premodal-login" id="md-report" tabindex="-1" role="dialog" aria-labelledby="modallogintitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="modal-close" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></div>
				<h4 class="text-white"><?= $__l['rp.t'] ?></h4>
				<p class="text-mute"><?= $__l['rp.m'] ?></p>
				<form data-submit="report" data-captcha="report" class="form">
					<input type="hidden" name="id" value="<?= $mv['id'] ?>">
					<input type="hidden" name="data_id" value="">
					<div class="form-group">
						<label><?= $__l['message'] ?></label>
						<textarea type="text" placeholder="" required class="form-control" name="message"></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block"><?= $__l['submit'] ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>