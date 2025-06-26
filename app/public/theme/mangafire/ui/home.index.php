<div class="welcome-top">
    <div class="welcome-bg"><img src="/theme/<?= $setting['theme'] ?>/images/index.jpg" /></div>
    <div class="container max-md position-relative z-index-2">
        <div class="py-4">
            <h1 class="shadow-sm"><b><?= (($setting['home']['h1']) ? $setting['home']['h1'] : $setting['h1']) ?></b></h1>
            <h2 class="shadow-sm"><?= (($setting['home']['info']) ? un_htmlchars($setting['home']['info']) : $wdescription) ?></h2>
            <a class="btn btn-lg shadow-sm text-uppercase btn-primary mt-3" href="<?= $setting['home']['url'] ?>"><?= $__l['goto'] ?> <?= $host ?> <i class="fa-regular fa-arrow-right fa-beat"></i></a>
        </div>
    </div>
</div>
<div class="welcome-bottom">
    <div class="container max-md p-0 p-sm-3">
        <div class="bg-secondary shadow-sm">
            <article>
                <div class="sharethis-inline-share-buttons mb-3"></div>
                <h3 class="sub-heading"><?= (($setting['home']['h1']) ? $setting['home']['h1'] : $setting['h1']) ?></h3>
                <?php if ($setting['home']['content']) { ?>
                    <?= un_htmlchars($setting['home']['content']) ?>
                <?php } ?>
            </article>
        </div>
    </div>
</div>