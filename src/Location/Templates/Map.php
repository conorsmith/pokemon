<?php include __DIR__ . "/BottomNav.php" ?>

<div class="d-grid gap-4">

    <div>
        <div class="d-flex justify-content-between align-items-end">
            <h2 class="mb-0"><?=$currentLocation->name?></h2>
            <div>
                <span class="badge bg-secondary"><?=$currentLocation->region?></span>
            </div>
        </div>

        <?php if ($summary->isShown) : ?>
            <div class="d-flex justify-content-between" style="font-size: 0.8rem; margin-top: 0.5rem;">
                <div>
                    <?php if ($summary->trainers->isShown) : ?>
                        <i class="fas fa-fw fa-user"></i> <?=$summary->trainers->beaten?> / <?=$summary->trainers->total?>
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
                    <?php if ($summary->pokemon->gift) : ?>
                        <i class="fas fa-fw fa-gift"></i>
                    <?php endif ?>
                </div>
            </div>
        <?php endif ?>

    </div>

    <style>
        .directions-cardinal button {
            flex-direction: column;
        }
        
        @media (min-width: 450px) {
            .directions-cardinal button {
                flex-direction: row;
            }
        }

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

            <?php if ($currentLocation->hasCardinalDirections) : ?>

                <div class="d-grid gap-2 directions-cardinal" style="grid-template-columns: repeat(3, 1fr); grid-auto-rows: 1fr; align-items: stretch;">

                    <div></div>
                    <div>
                        <?php if (isset($currentLocation->north)) : ?>
                            <?php $location = $currentLocation->north ?>
                            <?php require __DIR__ . "/MapMoveButton.php" ?>
                        <?php else : ?>
                            <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                        <?php endif ?>
                    </div>
                    <div></div>

                    <div>
                        <?php if (isset($currentLocation->west)) : ?>
                            <?php $location = $currentLocation->west ?>
                            <?php require __DIR__ . "/MapMoveButton.php" ?>
                        <?php else : ?>
                            <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                        <?php endif ?>
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center; min-height: 37.6px;">
                        <?=$currentLocation->name?>
                    </div>
                    <div>
                        <?php if (isset($currentLocation->east)) : ?>
                            <?php $location = $currentLocation->east ?>
                            <?php require __DIR__ . "/MapMoveButton.php" ?>
                        <?php else : ?>
                            <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                        <?php endif ?>
                    </div>

                    <div></div>
                    <div>
                        <?php if (isset($currentLocation->south)) : ?>
                            <?php $location = $currentLocation->south ?>
                            <?php require __DIR__ . "/MapMoveButton.php" ?>
                        <?php else : ?>
                            <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                        <?php endif ?>
                    </div>
                    <div></div>
                </div>

            <?php elseif ($currentLocation->hasVerticalDirections) : ?>

                <div class="d-grid gap-2" style="grid-template-columns: repeat(1, 1fr); grid-auto-rows: 1fr; align-items: stretch;">

                    <div>
                        <?php if (isset($currentLocation->up)) : ?>
                            <?php $location = $currentLocation->up ?>
                            <?php require __DIR__ . "/MapMoveButton.php" ?>
                        <?php else : ?>
                            <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                        <?php endif ?>
                    </div>

                    <div style="display: flex; justify-content: center; align-items: center; min-height: 37.6px; gap: 4px;">
                        <?=$currentLocation->name?>
                        <?php if ($currentLocation->section) : ?>
                            <span class="badge text-bg-light"><?=$currentLocation->section?></span>
                        <?php endif ?>
                    </div>

                    <div>
                        <?php if (isset($currentLocation->down)) : ?>
                            <?php $location = $currentLocation->down ?>
                            <?php require __DIR__ . "/MapMoveButton.php" ?>
                        <?php else : ?>
                            <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                        <?php endif ?>
                    </div>
                </div>

            <?php endif ?>

            <?php if ($currentLocation->directions && ($currentLocation->hasCardinalDirections || $currentLocation->hasVerticalDirections)) : ?>

            <?php endif ?>

            <?php if ($currentLocation->directions) : ?>

                <div class="d-grid gap-2">

                    <?php foreach ($currentLocation->directions as $location) : ?>

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
