<!--Begin: Detail-->
<div id="ani_detail">
	<div class="ani_detail-stage">
		<div class="container">
			<div class="detail-breadcrumb">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/"><?= $__l['home'] ?></a></li>
						<?php
						foreach ($breadcrumb as $k => $v) {
							echo '<li class="breadcrumb-item ' . (($k == count($breadcrumb) - 1) ? 'active' : '') . '"><a href="' . $v['url'] . '" title="' . $v['name'] . '">' . $v['name'] . '</a></li>';
						}
						?>
					</ol>
				</nav>
			</div>
			<div class="anis-content">
				<div class="anisc-poster">
					<div class="manga-poster">
						<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?= image($mv['thumb'], 300) ?>" width="220" height="330" title="<?= $mv['title'] ?>" alt="<?= $mv['title'] ?>" class="manga-poster-img lazyload">
					</div>
				</div>
				<div class="anisc-detail">
					<h2 class="manga-name"><?= $mv['title'] ?></h2>
					<?= (($data['another']) ? '<div class="manga-name-or">' . $data['another'] . '</div>' : '') ?>
					<div id="mal-sync"></div>
					<div class="manga-buttons">
						<?php if($read_url) { ?>
						<a href="<?= $read_url ?>" class="btn btn-primary btn-play smoothlink"><i class="fas fa-eye mr-2"></i><?= $__l['Read.Now'] ?></a>
						<?php } ?>
						<div class="dr-fav" id="reading-list-info">
							<span id="favorite-state">
								<a href="#" data-id="<?= $mv['id'] ?>" data-remove="<?= (($_SESSION['__fav'][$mv['id']]) ? 1 : 0) ?>" class="btn btn-light favorite">
									<?= (($_SESSION['__fav'][$mv['id']]) ? '<i class="fas fa-trash"></i>' : '<i class="fas fa-heart"></i>') ?>
								</a>
							</span>
							<span data-toggle="modal" data-target="#md-report" class="btn btn-danger report"><i class="fa fa-flag"></i></span>
						</div>
					</div>
					<div class="sort-desc">
						<?= (($data['genre']) ? '<div class="genres">' . get_tags($data['genre'], 'genre', 1) . '</div>' : '') ?>
						<?php if ($data['info']) { ?>
							<div class="description">
								<?=(($setting['vinfo'])?str_replace(['[title]','[year]'],[$mv['title'],date("Y")],$setting['vinfo']).'<br>':'')?>
								<?= un_htmlchars($data['info']) ?>
							</div>
							<div class="description-more">
								<button type="button" data-toggle="modal" data-target="#modaldesc" class="btn btn-xs text-white">+ <?= $__l['more'] ?>
								</button>
							</div>
						<?php } ?>
						<div class="anisc-info-wrap">
							<div class="anisc-info">
								<div class="item item-title">
									<span class="item-head"><?= $__l['type'] ?>:</span>
									<a class="name" href="<?= $res[$mv['type']] ?>"><?= $cftps[$mv['type']] ?></a>
								</div>
								<div class="item item-title">
									<span class="item-head"><?= $__l['status'] ?>:</span>
									<span class="name"><?= slugTitle($mv['status']) ?></span>
								</div>
								<?= (($data['author']) ? '<div class="item item-title"><span class="item-head">' . $__l['author'] . ':</span> ' . get_tags($data['author'], 'author', 1) . '</div>' : '') ?>
								<?= (($data['magazine']) ? '<div class="item item-title"><span class="item-head">' . $__l['magazine'] . ':</span> ' . get_tags($data['magazine'], 'magazine', 1) . '</div>' : '') ?>
								<?= (($data['published']) ? '<div class="item item-title"><span class="item-head">' . $__l['Published'] . ':</span> <span class="name">' . $data['published'] . '</span></div>' : '') ?>
								<?php
								if ($build['pram']) {
									foreach ($build['pram'] as $v) {
										if ($data[$v['name']]) {
											echo '
											<div class="item item-title">
												<span class="item-head">' . $v['label'] . ':</span>
												<span class="name">' . $data[$v['name']] . '</span>
											</div>
											';
										}
									}
								}
								?>
								<div class="item item-title">
									<span class="item-head"><?= $__l['views'] ?>:</span>
									<span class="name view"><?= number_format($mv['view']) ?></span>
								</div>
								<div class="detail-toggle">
									<button type="button" class="btn btn-sm btn-light"><i class="fas fa-angle-down mr-2"></i></button>
								</div>
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
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="social-in-box">
						<div class="sharethis-inline-share-buttons"></div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<!--/End: Detail-->
<div id="main-wrapper" class="page-layout page-detail">
	<div class="container">
		<div id="mw-2col">
			<div id="main-content">
				<?= ads('post-1') ?>

				<section id="chapters-list" class="block_area block_area_category block_area_chapters">
					<div class="block_area-header mb-0">
						<div class="bah-heading bah-heading-tabs">
							<ul class="nav nav-tabs chap-tabs">
								<?php if ($arr['chapters']['chap']) { ?>
									<li class="nav-item"><a data-toggle="tab" href="#list-chapter" class="nav-link active show"><?= $__l['List.Chapter'] ?></a></li>
								<?php } ?>
								<?php if ($arr['chapters']['vol']) { ?>
									<li class="nav-item"><a data-toggle="tab" href="#list-vol" class="nav-link"><?= $__l['List.Volume'] ?></a></li>
								<?php } ?>
							</ul>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="tab-content">
						<?php if ($arr['chapters']['chap']) { ?>
							<div id="list-chapter" class="tab-pane active show">
								<div class="chapter-section">
									<div class="chapter-s-lang">
										<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-sm">
											<i class="far fa-file-alt mr-2"></i>
											<?= $__l['Language'] ?>:
											<span></span>
											<i class="fas fa-angle-down ml-2"></i>
										</button>
										<div class="dropdown-menu dropdown-menu-model" aria-labelledby="ssc-list">
											<?php
											foreach ($arr['chapters']['chap'] as $lang => $chap) {
												echo '<a class="dropdown-item c-select-lang lang-item" href="javascript:;" data-type="chap" data-code="' . $lang . '">[' . strtoupper($lang) . '] ' . $language[$lang] . ' (' . count($chap) . ' ' . $__l['Chapters'] . ')</a>';
											}
											?>
										</div>
									</div>
									<div class="chapter-s-search">
										<form class="preform search-reading-item-form">
											<div class="css-icon"><i class="fas fa-search"></i></div>
											<input class="form-control search-reading-item search-reading-item2" type="text" placeholder="<?= $__l['cfocus'] ?>" autofocus>
										</form>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="chapters-list-ul">
									<?php
									foreach ($arr['chapters']['chap'] as $lang => $chap) {
										echo '<ul class="ulclear reading-list lang-chapters" style="display:none" id="' . $lang . '-chaps">';
										foreach ($chap as $name => $v) {
											$cur	=	pUrl($mv['slug'] . '/' . $lang . '/chapter-' . $name);
											if($change[$cur]) {
												$chap_url  =  urls($mv['slug'] . '/' . $lang . '/chapter-' . $name.'-i'.$change[$cur], 'post');
											}else {
												$chap_url  =  urls($mv['slug'] . '/' . $lang . '/chapter-' . $name, 'post');
											}
											echo '
										<li class="item reading-item chapter-item" data-id="' . $v['id'] . '" data-number="' . $name . '">
											<a href="' . $chap_url . '" class="item-link" title="' . $__l['Chapter'] . ' ' . $name . (($v['title']) ? ': ' . $v['title'] : '') . '">
												<span class="arrow mr-2"><i class="far fa-file-alt"></i></span>
												<span class="name"><strong>' . xN($name) .'</strong>'. (($v['title']) ? ': ' . $v['title'] : '') . '</span>
												<span class="item-read"><i class="fas fa-glasses mr-1"></i> ' . $__l['Read'] . '</span>
											</a>
											<div class="clearfix"></div>
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
							<div id="list-vol" class="tab-pane">
								<div class="chapter-section">
									<div class="chapter-s-lang">
										<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-sm">
											<i class="far fa-file-alt mr-2"></i>
											<?= $__l['Language'] ?>:
											<span></span>
											<i class="fas fa-angle-down ml-2"></i>
										</button>
										<div class="dropdown-menu dropdown-menu-model" aria-labelledby="ssc-list">
											<?php
											foreach ($arr['chapters']['vol'] as $lang => $chap) {
												echo '<a class="dropdown-item c-select-lang lang-item" href="javascript:;" data-type="vol" data-code="' . $lang . '">[' . strtoupper($lang) . '] ' . $language[$lang] . ' (' . count($chap) . ' ' . $__l['Volumes'] . ')</a>';
											}
											?>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="chapters-list-ul volume-list-ul">
									<?php
									foreach ($arr['chapters']['vol'] as $lang => $chap) {
										echo '<ul class="ulclear reading-list lang-chapters" style="display:none" id="' . $lang . '-vols">';
										foreach ($chap as $name => $v) {
											$chap_url	=	urls($mv['slug'] . '/' . $lang . '/volume-' . $name, 'post');
											echo '
										<li class="item reading-item chapter-item" data-id="' . $v['id'] . '" data-number="' . $name . '">
											<a href="' . $chap_url . '" class="item-link" title="' . $__l['Chapter'] . ' ' . $name . (($v['title']) ? ': ' . $v['title'] : '') . '">
												<span class="arrow mr-2"><i class="fas fa-book"></i></span>
												<span class="name">' . $__l['Volume'] . ' ' . $name . (($v['title']) ? ': ' . $v['title'] : '') . '</span>
												<span class="item-read"><i class="fas fa-glasses mr-1"></i> ' . $__l['Read'] . '</span>
											</a>
											<div class="clearfix"></div>
										</li>
										';
										}
										echo '</ul>';
									}
									?>
								</div>

							</div>
						<?php } ?>
					</div>
				</section>

				<?php if ($setting['comment'] > 0) { ?>
					<section id="comment" class="block_area block_area_comment">
						<div class="block_area-header">
							<h2 class="cat-heading"><?= $__l['comment'] ?></h2>
						</div>
						<div class="comments-content">
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
			</div>
			<div id="main-sidebar">
				<section class="block_area block_area_sidebar block_area-realtime">
					<div class="block_area-header">
						<div class="float-left bah-heading">
							<h2 class="cat-heading"><?= $__l['tags'] ?></h2>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="tags">
						<?= get_tags($data['tag'], 'tag', 1, '') ?>
						<?= get_tags_title($mv['title'], date("Y"), $setting['tags'], 1, ''); ?>
					</div>
				</section>
				<?= ads('post-2') ?>
				<?php require_once('right.php'); ?>
				<?php if ($arr['relate']) { ?>
					<section class="block_area block_area_sidebar block_area-realtime">
						<div class="block_area-header">
							<div class="float-left bah-heading">
								<h2 class="cat-heading"><?= $__l['rtitle'] ?></h2>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="block_area-content">
							<div class="cbox cbox-list cbox-realtime">
								<div class="featured-block-ul">
									<ul class="ulclear">
										<?= movies($arr['relate'], 'right') ?>
									</ul>
								</div>
							</div>
						</div>
					</section>
				<?php } ?>

			</div>
			<div class="clearfix"></div>
		</div>
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
	<div class="modal fade premodal" id="modaldesc" tabindex="-1" role="dialog" aria-labelledby="modalldesctitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalldesctitle"><?= $mv['title'] ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="description-modal"><?= un_htmlchars($data['info']) ?></div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<div class="modal premodal premodal-login" id="md-report" tabindex="-1" role="dialog" aria-labelledby="modallogintitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?= $__l['rp.t'] ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p><?= $__l['rp.m'] ?></p>
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