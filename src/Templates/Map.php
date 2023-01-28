<div class="d-grid gap-4">

    <h1 style="text-align: center;"><?=$currentLocation->name?></h1>

    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger"><?=$error?></div>
    <?php endforeach ?>

    <?php foreach ($successes as $success) : ?>
        <div class="alert alert-success"><?=$success?></div>
    <?php endforeach ?>

    <div class="d-grid gap-2">

        <form method="POST" class="d-grid">
            <input type="hidden" name="location" value="<?=$currentLocation->id?>">
            <button type="submit" class="btn btn-primary btn-lg" <?=$canEncounter ? "" : "disabled"?>>Search for Wild Pokémon</button>
        </form>

    </div>

    <div class="card" style="text-align: center;">

        <?php if ($currentLocation->hasCardinalDirections) : ?>

            <div class="card-body d-grid gap-2" style="grid-template-columns: repeat(3, 1fr); grid-auto-rows: 1fr; align-items: stretch;">

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

</div>
