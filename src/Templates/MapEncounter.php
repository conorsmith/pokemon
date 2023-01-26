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
                        <form method="POST" action="/map/move" style="height: 100%;">
                            <input type="hidden" name="location" value="<?=$currentLocation->north->id?>">
                            <button type="submit" class="btn btn-primary" style="width: 100%; height: 100%;"><?=$currentLocation->north->name?></button>
                        </form>
                    <?php else : ?>
                        <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                    <?php endif ?>
                </div>
                <div></div>

                <div>
                    <?php if (isset($currentLocation->west)) : ?>
                        <form method="POST" action="/map/move" style="height: 100%;">
                            <input type="hidden" name="location" value="<?=$currentLocation->west->id?>">
                            <button type="submit" class="btn btn-primary" style="width: 100%; height: 100%;"><?=$currentLocation->west->name?></button>
                        </form>
                    <?php else : ?>
                        <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                    <?php endif ?>
                </div>
                <div style="display: flex; justify-content: center; align-items: center; min-height: 37.6px;">
                    <?=$currentLocation->name?>
                </div>
                <div>
                    <?php if (isset($currentLocation->east)) : ?>
                        <form method="POST" action="/map/move" style="height: 100%;">
                            <input type="hidden" name="location" value="<?=$currentLocation->east->id?>">
                            <button type="submit" class="btn btn-primary" style="width: 100%; height: 100%;"><?=$currentLocation->east->name?></button>
                        </form>
                    <?php else : ?>
                        <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                    <?php endif ?>
                </div>

                <div></div>
                <div>
                    <?php if (isset($currentLocation->south)) : ?>
                        <form method="POST" action="/map/move" style="height: 100%;">
                            <input type="hidden" name="location" value="<?=$currentLocation->south->id?>">
                            <button type="submit" class="btn btn-primary" style="width: 100%; height: 100%;"><?=$currentLocation->south->name?></button>
                        </form>
                    <?php else : ?>
                        <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                    <?php endif ?>
                </div>
                <div></div>
            </div>

        <?php endif ?>

        <?php if ($currentLocation->directions && $currentLocation->hasCardinalDirections) : ?>

            <hr class="m-0">

        <?php endif ?>

        <?php if ($currentLocation->directions) : ?>

            <div class="card-body d-grid gap-2 p-2">

                <?php foreach ($currentLocation->directions as $location) : ?>

                    <form method="POST" action="/map/move" class="d-grid">
                        <input type="hidden" name="location" value="<?=$location->id?>">
                        <button type="submit" class="btn btn-primary"><?=$location->name?></button>
                    </form>

                <?php endforeach ?>

            </div>

        <?php endif ?>

    </div>

    <div class="card">
        <div class="card-header" style="text-align: center;">
            <h3 class="mb-0">Trainers</h3>
        </div>
        <div class="card-body" style="text-align: center;">
            <strong><?=$challengeTokens?></strong> Challenge Tokens
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

</div>
