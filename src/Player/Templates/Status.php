<div class="d-grid gap-4">

    <div class="d-flex gap-3 justify-content-between">
        <div>
            <img src="/assets/FRLG_Red_Intro.png">
        </div>
        <div class="card flex-grow-1">
            <div class="card-body">

            </div>
        </div>
    </div>

    <?php foreach ($regionalStatuses as $regionalStatus) : ?>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5><?=$regionalStatus->name?></h5>
                    <?php if ($regionalStatus->isChampion) : ?>
                        <div>
                            <a href="/<?=$instanceId?>/hall-of-fame/<?=$regionalStatus->region?>"><i class="fas fa-trophy"></i></a>
                        </div>
                    <?php endif ?>
                </div>
                <div style="margin-top: 1rem; display: grid; grid-template-columns: repeat(4, 1fr); grid-auto-rows: 1fr; align-items: stretch; grid-column-gap: 0.4rem; grid-row-gap: 0.4rem;">
                    <?php foreach ($regionalStatus->badges as $badge) : ?>
                        <?php if ($badge) : ?>
                            <div style="text-align: center; background: #f6f6f6; border-radius: 0.4rem; padding: 0.6rem;">
                                <div><img src="<?=$badge->imageUrl?>" style="width: 50px;"></div>
                                <div style="line-height: 100%; font-weight: bold; margin-top: 0.4rem;"><small><?=$badge->name?></small></div>
                            </div>
                        <?php else : ?>
                            <div class="d-flex align-items-center justify-content-center" style="text-align: center; min-height: 90px; background: #f6f6f6; border-radius: 0.4rem; color: #ccc;">
                                <i class="far fa-fw fa-circle"></i>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>

</div>
