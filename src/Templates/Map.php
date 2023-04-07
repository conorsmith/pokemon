<div class="d-grid gap-4">

    <div class="d-flex justify-content-between align-items-end">
        <h2 class="mb-0"><?=$currentLocation->name?></h2>
        <div>
            <span class="badge bg-secondary"><?=$currentLocation->region?></span>
        </div>
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
    </style>

    <div class="card" style="text-align: center;">

        <?php if ($currentLocation->hasCardinalDirections) : ?>

            <div class="card-body d-grid gap-2 directions-cardinal" style="grid-template-columns: repeat(3, 1fr); grid-auto-rows: 1fr; align-items: stretch;">

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

            <div class="card-body d-grid gap-2" style="grid-template-columns: repeat(1, 1fr); grid-auto-rows: 1fr; align-items: stretch;">

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

            <hr class="m-0">

        <?php endif ?>

        <?php if ($currentLocation->directions) : ?>

            <div class="card-body d-grid gap-2 p-2">

                <?php foreach ($currentLocation->directions as $location) : ?>

                    <?php require __DIR__ . "/MapMoveButton.php" ?>

                <?php endforeach ?>

            </div>

        <?php endif ?>

    </div>

    <?php if ($currentLocation->hasEncounters) : ?>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div><strong>Wild Pokémon</strong></div>
                <div class="d-flex" style="text-align: center; gap: 4px;">
                    <img src="https://archives.bulbagarden.net/media/upload/9/93/Bag_Pok%C3%A9_Ball_Sprite.png" style="filter: grayscale(1);">
                    <span><?=$pokeballs?></span>
                </div>
            </div>
            <div class="card-body d-flex gap-2">
                <?php if ($currentLocation->encounters->walking) : ?>
                    <form method="POST" action="/encounter" class="d-grid flex-fill">
                        <input type="hidden" name="location" value="<?=$currentLocation->id?>">
                        <input type="hidden" name="encounterType" value="walking">
                        <button type="submit" class="btn btn-primary btn-lg" <?=$canEncounter ? "" : "disabled"?>><i class="fas fa-fw fa-shoe-prints"></i></button>
                    </form>
                <?php endif ?>
                <?php if ($currentLocation->encounters->surfing) : ?>
                    <form method="POST" action="/encounter" class="d-grid flex-fill">
                        <input type="hidden" name="location" value="<?=$currentLocation->id?>">
                        <input type="hidden" name="encounterType" value="surfing">
                        <button type="submit" class="btn btn-primary btn-lg" <?=$canEncounter ? "" : "disabled"?>><i class="fas fa-fw fa-water"></i></button>
                    </form>
                <?php endif ?>
                <?php if ($currentLocation->encounters->fishing) : ?>
                    <form method="POST" action="/encounter" class="d-grid flex-fill">
                        <input type="hidden" name="location" value="<?=$currentLocation->id?>">
                        <input type="hidden" name="encounterType" value="fishing">
                        <button type="submit" class="btn btn-primary btn-lg" <?=$canEncounter ? "" : "disabled"?>><i class="fas fa-fw fa-fish"></i></button>
                    </form>
                <?php endif ?>
                <?php if ($currentLocation->encounters->rockSmash) : ?>
                    <form method="POST" action="/encounter" class="d-grid flex-fill">
                        <input type="hidden" name="location" value="<?=$currentLocation->id?>">
                        <input type="hidden" name="encounterType" value="rockSmash">
                        <button type="submit" class="btn btn-primary btn-lg" <?=$canEncounter ? "" : "disabled"?>><i class="fab fa-fw fa-sith"></i></button>
                    </form>
                <?php endif ?>
            </div>
        </div>
    <?php endif ?>

    <?php if (count($trainers) > 0) : ?>

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div><strong>Trainers</strong></div>
                <div class="d-flex" style="text-align: center; gap: 4px;">
                    <img src="https://archives.bulbagarden.net/media/upload/c/c4/Bag_Contest_Pass_Sprite.png">
                    <span><?=$challengeTokens?></span>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($trainers as $trainer) : ?>
                    <li class="list-group-item d-flex align-items-start">
                        <div class="me-2" style="width: 64px;">
                            <?php if (!is_null($trainer->imageUrl)) : ?>
                                <img src="<?=$trainer->imageUrl?>">
                            <?php endif ?>
                        </div>
                        <div>
                            <div><strong>
                                <?=$trainer->name?>
                                <?php if ($trainer->isGymLeader) : ?>
                                    <i class="fas fa-fw fa-medal"></i>
                                <?php endif ?>
                            </strong></div>
                            <div>
                                <small><?=$trainer->team?> Pokémon</small>
                                <?php if ($trainer->isGymLeader) : ?>
                                    <small>&middot; <?=$trainer->leaderBadge?></small>
                                <?php endif ?>
                            </div>
                            <div class="d-flex align-items-center" style="margin-top: 0.4rem;">
                                <form method="POST" action="/battle/trainer/<?=$trainer->id?>" style="margin-right: 0.6rem;">
                                    <button type="submit" class="btn btn-outline-dark btn-sm" <?=$trainer->canBattle ? "" : "disabled"?>>Battle</button>
                                </form>
                                <?php if ($trainer->lastBeaten) : ?>
                                    <span style="font-size: 0.8rem;">Last beaten <?=$trainer->lastBeaten?></span>
                                <?php endif ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>

    <?php endif ?>

    <?php if ($legendary) : ?>

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div><strong>Legendary Encounter</strong></div>
                <div class="d-flex" style="text-align: center; gap: 4px;">
                    <img src="https://archives.bulbagarden.net/media/upload/c/c4/Bag_Contest_Pass_Sprite.png">
                    <span><?=$challengeTokens?></span>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex align-items-start">
                    <div class="pokemon-image">
                        <img src="<?=$legendary->imageUrl?>">
                    </div>
                    <div>
                        <div><strong>
                                <?=$legendary->name?>
                            </strong></div>
                        <div>
                            <small><i class="fas fa-star"></i> Lv <?=$legendary->level?></small>
                        </div>
                        <div class="d-flex align-items-center" style="margin-top: 0.4rem;">
                            <form method="POST" action="/encounter" style="margin-right: 0.6rem;">
                                <input type="hidden" name="legendary" value="<?=$legendary->number?>">
                                <button type="submit" class="btn btn-outline-dark btn-sm" <?=$legendary->canBattle ? "" : "disabled"?>>Battle</button>
                            </form>
                            <?php if ($legendary->lastEncountered) : ?>
                                <span style="font-size: 0.8rem;">Last encountered <?=$legendary->lastEncountered?></span>
                            <?php endif ?>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

    <?php endif ?>

    <?php if ($eliteFour) : ?>

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div><strong>Elite Four</strong></div>
                <div class="d-flex" style="text-align: center; gap: 4px;">
                    <img src="https://archives.bulbagarden.net/media/upload/c/c4/Bag_Contest_Pass_Sprite.png">
                    <span><?=$challengeTokens?></span>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex flex-column">
                    <div class="d-flex justify-content-center w-100">
                        <?php foreach ($eliteFour->memberImageUrls as $memberImageUrl) : ?>
                            <div class="me-2" style="width: 64px;">
                                <img src="<?=$memberImageUrl?>">
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div class="d-flex justify-content-center w-100 mt-3 mb-2">
                        <form method="POST" action="/challenge/elite-four/<?=$eliteFour->region?>">
                            <button type="submit" class="btn btn-outline-dark btn-sm" <?=$eliteFour->canChallenge ? "" : "disabled"?>>
                                Challenge the Elite Four
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>

    <?php endif ?>

</div>
