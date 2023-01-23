<?php foreach ($successes as $success) : ?>
    <div class="alert alert-success"><?=$success?></div>
<?php endforeach ?>

<ul class="list-group">

    <?php foreach ($items as $item) : ?>
        <li class="list-group-item d-flex justify-content-between">
            <div class="d-flex">
                <div class="me-2" style="width: 24px; text-align: center;">
                    <img src="<?=$item->imageUrl?>">
                </div>
                <div><?=$item->name?></div>
            </div>
            <div><?=$item->amount?></div>
        </li>
    <?php endforeach ?>

</ul>

<ul class="list-group" style="margin-top: 2rem;">
    <?php foreach ($team as $pokemon) : ?>
        <li class="list-group-item d-flex">
            <img src="<?=$pokemon->imageUrl?>" style="width: 6rem; margin-right: 1rem;">
            <div>
                <h5><?=$pokemon->name?></h5>
                <p class="mb-0">
                    <span>
                        <span class="badge bg-<?=$pokemon->primaryType?>" style="text-transform: uppercase;">
                            <?=$pokemon->primaryType?>
                        </span>
                        <?php if ($pokemon->secondaryType) : ?>
                            <span class="badge bg-<?=$pokemon->secondaryType?>" style="text-transform: uppercase;">
                                <?=$pokemon->secondaryType?>
                            </span>
                        <?php endif ?>
                    </span>
                        <span style="margin: 0 0.4rem;">
                        Lv <?=$pokemon->level?>
                    </span>
                </p>
            </div>
        </li>
    <?php endforeach ?>
</ul>

<h2 style="margin-top: 2rem; text-align: center;">Gym Badges</h2>

<div style="margin-top: 1rem; display: grid; grid-template-columns: repeat(4, 1fr); grid-auto-rows: 1fr; align-items: stretch; grid-column-gap: 0.4rem; grid-row-gap: 0.4rem;">
    <?php foreach ($badges as $badge) : ?>
        <div style="text-align: center; background: #f6f6f6; border-radius: 0.4rem; padding: 0.6rem;">
            <div><img src="<?=$badge->imageUrl?>" style="width: 50px;"></div>
            <div style="line-height: 100%; font-weight: bold; margin-top: 0.4rem;"><small><?=$badge->name?></small></div>
        </div>
    <?php endforeach ?>
    <?php for ($i = count($badges); $i < 8; $i++) : ?>
        <div class="d-flex align-items-center justify-content-center" style="text-align: center; min-height: 90px; background: #f6f6f6; border-radius: 0.4rem; color: #ccc;">
            <i class="far fa-fw fa-circle"></i>
        </div>
    <?php endfor ?>
</div>
