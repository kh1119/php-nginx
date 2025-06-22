<div id="home">
    <div class="top-home">
        <div class="container">
            <div class="top-content">
                <div id="xsearch" class="home-search">
                    <div class="search-content">
                        <form action="/" search_form="true" method="get" autocomplete="off" id="search-home-form">
                            <div class="search-submit">
                                <div class="search-icon"><i class="fa fa-search"></i></div>
                            </div>
                            <input type="text" name="q" class="form-control no-suggest search-input" placeholder="<?= $__l['qfocus'] ?>" required>
                        </form>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="xbuttons"><a href="<?= $setting['home']['url'] ?>" class="btn btn-primary"><?= $__l['goto'] ?> <?= $host ?> <i class="fas fa-caret-right ml-2"></i></a></div>
            </div>
        </div>
    </div>
    <div class="content-home">
        <div class="container">
            <div class="social-home-block mb-4">
                <div class="shb-icon"></div>
                <div class="shb-left"><?= $__l['share.t'] ?></div>
                <div class="sharethis-inline-share-buttons"></div>
                <div class="clearfix"></div>
            </div>
            <h1 class="A1headline"><?= (($setting['home']['h1']) ? $setting['home']['h1'] : $setting['h1']) ?></h1>
            <p><?= (($setting['home']['info']) ? un_htmlchars($setting['home']['info']) : $wdescription) ?></p>
            <?php if ($setting['home']['content']) { ?>
                <?= un_htmlchars($setting['home']['content']) ?>
            <?php } ?>
        </div>
    </div>
</div>