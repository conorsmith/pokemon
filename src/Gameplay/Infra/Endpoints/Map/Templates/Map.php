<?php include __DIR__ . "/BottomNav.php" ?>

<div class="d-grid gap-2">

    <div>
        <div class="d-flex gap-2 align-items-end">
            <h2 class="mb-0"><?=$currentLocation->name?></h2>
            <div>
                <?=$currentLocation->section?>
            </div>
        </div>

        <?php if ($summary->isShown) : ?>
            <div class="d-flex justify-content-between" style="min-height: 26px; margin-top: 0.5rem;">
                <div>
                    <span class="badge bg-secondary"><?=$currentLocation->region?></span>
                    <?php if ($summary->trainers->isShown) : ?>
                        <i class="fas fa-fw fa-user"></i>
                        <span class="font-monospace"><?=$summary->trainers->beaten?>/<?=$summary->trainers->total?></span>
                    <?php endif ?>
                </div>
                <div>
                    <?php if ($summary->pokemon->walking) : ?>
                        <i class="fas fa-fw fa-shoe-prints"></i>
                    <?php endif ?>
                    <?php if ($summary->pokemon->surfing) : ?>
                        <i class="fas fa-fw fa-water"></i>
                    <?php endif ?>
                    <?php if ($summary->pokemon->fishing) : ?>
                        <i class="fas fa-fw fa-fish"></i>
                    <?php endif ?>
                    <?php if ($summary->pokemon->rockSmash) : ?>
                        <i class="fab fa-fw fa-sith"></i>
                    <?php endif ?>
                    <?php if ($summary->pokemon->headbutt) : ?>
                        <i class="fas fa-fw fa-tree"></i>
                    <?php endif ?>
                    <?php if ($summary->pokemon->fixed) : ?>
                        <i class="fas fa-fw fa-map-marked"></i>
                    <?php endif ?>
                    <?php if ($summary->pokemon->legendary) : ?>
                        <i class="fas fa-fw fa-star"></i>
                    <?php endif ?>
                    <?php if ($summary->pokemon->gift) : ?>
                        <i class="fas fa-fw fa-gift"></i>
                    <?php endif ?>
                </div>
            </div>
        <?php endif ?>

    </div>

    <style>
        .map {
            max-width: 100%;
            object-fit: contain;
        }

        .map--kanto-victory-road {
            height: 145px;
            width: 192px;
            object-fit: cover;
            object-position: 100% 0;
            border-left: 1px solid #000;
        }

        .map--kanto-johto-border {
            height: 145px;
            width: 192px;
            object-fit: cover;
            object-position: 60% 0;
            border-left: 1px solid #000;
            border-right: 1px solid #000;
        }
    </style>

    <div class="card" style="text-align: center;">

        <div class="card-body d-grid gap-2">

            <?php if ($map->imageUrl) : ?>
                <div style="min-height: 145px;">
                    <img src="<?=$map->imageUrl?>" class="map <?=$map->class?>">
                </div>
            <?php endif ?>

            <?php if ($currentLocation->directions || $currentLocation->hasCardinalDirections || $currentLocation->hasVerticalDirections) : ?>

                <div class="d-grid gap-2" style="grid-auto-columns: minmax(0, 1fr); grid-auto-flow: column;">

                    <div class="d-grid gap-2" style="height: fit-content;">

                        <?php if ($currentLocation->directions) : ?>

                            <?php foreach ($currentLocation->directions as $location) : ?>

                                <?php require __DIR__ . "/MapMoveButton.php" ?>

                            <?php endforeach ?>

                        <?php endif ?>

                    </div>

                    <?php if ($currentLocation->hasCardinalDirections) : ?>

                        <div class="d-grid gap-2" style="height: fit-content; grid-template-columns: repeat(3, 1fr); grid-auto-rows: 1fr;">

                            <div></div>
                            <div>
                                <?php if (isset($currentLocation->north)) : ?>
                                    <?php $location = $currentLocation->north ?>
                                    <form method="POST" action="/<?=$instanceId?>/map/move">
                                        <input type="hidden" name="location" value="<?=$location->id?>">
                                        <button type="submit"
                                                class="btn btn-primary d-flex align-items-center justify-content-center"
                                                style="width: 100%; gap: 4px;"
                                            <?=$location->isLocked ? "disabled" : ""?>
                                        >
                                            <i class="fas fa-fw fa-arrow-up" style="line-height: var(--bs-btn-line-height);"></i>
                                        </button>
                                    </form>

                                <?php else : ?>
                                    <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                                <?php endif ?>
                            </div>
                            <div></div>

                            <div>
                                <?php if (isset($currentLocation->west)) : ?>
                                    <?php $location = $currentLocation->west ?>
                                    <form method="POST" action="/<?=$instanceId?>/map/move">
                                        <input type="hidden" name="location" value="<?=$location->id?>">
                                        <button type="submit"
                                                class="btn btn-primary d-flex align-items-center justify-content-center"
                                                style="width: 100%; gap: 4px;"
                                            <?=$location->isLocked ? "disabled" : ""?>
                                        >
                                            <i class="fas fa-fw fa-arrow-left" style="line-height: var(--bs-btn-line-height);"></i>
                                        </button>
                                    </form>
                                <?php else : ?>
                                    <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                                <?php endif ?>
                            </div>
                            <div></div>
                            <div>
                                <?php if (isset($currentLocation->east)) : ?>
                                    <?php $location = $currentLocation->east ?>
                                    <form method="POST" action="/<?=$instanceId?>/map/move">
                                        <input type="hidden" name="location" value="<?=$location->id?>">
                                        <button type="submit"
                                                class="btn btn-primary d-flex align-items-center justify-content-center"
                                                style="width: 100%; gap: 4px;"
                                            <?=$location->isLocked ? "disabled" : ""?>
                                        >
                                            <i class="fas fa-fw fa-arrow-right" style="line-height: var(--bs-btn-line-height);"></i>
                                        </button>
                                    </form>
                                <?php else : ?>
                                    <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                                <?php endif ?>
                            </div>

                            <div></div>
                            <div>
                                <?php if (isset($currentLocation->south)) : ?>
                                    <?php $location = $currentLocation->south ?>
                                    <form method="POST" action="/<?=$instanceId?>/map/move">
                                        <input type="hidden" name="location" value="<?=$location->id?>">
                                        <button type="submit"
                                                class="btn btn-primary d-flex align-items-center justify-content-center"
                                                style="width: 100%; gap: 4px;"
                                            <?=$location->isLocked ? "disabled" : ""?>
                                        >
                                            <i class="fas fa-fw fa-arrow-down" style="line-height: var(--bs-btn-line-height);"></i>
                                        </button>
                                    </form>
                                <?php else : ?>
                                    <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                                <?php endif ?>
                            </div>
                            <div></div>
                        </div>

                    <?php elseif ($currentLocation->hasVerticalDirections) : ?>

                        <div class="d-grid gap-2" style="grid-template-columns: repeat(1, 1fr); grid-auto-rows: 1fr; align-items: stretch;">

                            <div style="min-height: 37.6px;">
                                <?php if (isset($currentLocation->up)) : ?>
                                    <?php $location = $currentLocation->up ?>
                                    <form method="POST" action="/<?=$instanceId?>/map/move">
                                        <input type="hidden" name="location" value="<?=$location->id?>">
                                        <button type="submit"
                                                class="btn btn-primary d-flex align-items-center justify-content-center"
                                                style="width: 100%; gap: 4px;"
                                            <?=$location->isLocked ? "disabled" : ""?>
                                        >
                                            <i class="fas fa-fw fa-arrow-up" style="line-height: var(--bs-btn-line-height);"></i>
                                        </button>
                                    </form>
                                <?php else : ?>
                                    <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                                <?php endif ?>
                            </div>

                            <div>
                                <?php if (isset($currentLocation->down)) : ?>
                                    <?php $location = $currentLocation->down ?>
                                    <form method="POST" action="/<?=$instanceId?>/map/move">
                                        <input type="hidden" name="location" value="<?=$location->id?>">
                                        <button type="submit"
                                                class="btn btn-primary d-flex align-items-center justify-content-center"
                                                style="width: 100%; gap: 4px;"
                                            <?=$location->isLocked ? "disabled" : ""?>
                                        >
                                            <i class="fas fa-fw fa-arrow-down" style="line-height: var(--bs-btn-line-height);"></i>
                                        </button>
                                    </form>
                                <?php else : ?>
                                    <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                                <?php endif ?>
                            </div>
                        </div>

                    <?php endif ?>

                </div>

            <?php endif ?>

            <?php if ($currentLocation->hasExits) : ?>

                <div>

                    <?php foreach ($currentLocation->exits as $location) : ?>

                        <?php require __DIR__ . "/MapMoveButton.php" ?>

                    <?php endforeach ?>

                </div>

            <?php endif ?>

        </div>

    </div>

    <?php if ($hallOfFame) : ?>
        <div class="card" style="text-align: center;">
            <div class="card-body d-grid gap-2 p-2">
                <a href="/<?=$instanceId?>/hall-of-fame/<?=$hallOfFame->region?>"
                        class="btn btn-warning"
                        style="font-weight: bold;"
                >
                    Hall of Fame
                </a>
            </div>
        </div>
    <?php endif ?>

</div>
