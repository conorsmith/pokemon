<nav class="navbar fixed-bottom bg-light">
    <div class="container-fluid">
        <div class="d-flex w-100 gap-4 justify-content-center" style="min-height: 40px;">
            <?php if ($wildPokemon->hasEncounters) : ?>
                <button class="navbar-toggler js-encounter-link" type="button">
                    <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: middle;">
                        <img src="/assets/items/Bag_Pok%C3%A9_Ball_Sprite.png" style="filter: grayscale(1);">
                    </span>
                </button>
            <?php endif ?>
            <?php if (count($trainers) > 0) : ?>
                <button class="navbar-toggler js-trainers-link" type="button">
                    <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: middle;">
                        <img src="/assets/items/Bag_Contest_Pass_Sprite.png">
                    </span>
                </button>
            <?php endif ?>
            <?php if ($legendary) : ?>
                <button class="navbar-toggler js-legendary-link" type="button">
                    <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: middle;">
                        <img src="/assets/items/Bag_Star_Piece_Sprite.png">
                    </span>
                </button>
            <?php endif ?>
            <?php if ($eliteFour) : ?>
                <button class="navbar-toggler js-elite-four-link" type="button">
                    <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: middle;">
                        <img src="/assets/items/Bag_Contest_Pass_Sprite.png">
                    </span>
                </button>
            <?php endif ?>
        </div>
    </div>
</nav>

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

    <?php if ($wildPokemon->hasEncounters) : ?>
        <div class="card js-encounter-block">
            <div class="card-header d-flex justify-content-between">
                <div><strong>Wild Pokémon</strong></div>
                <div class="d-flex" style="text-align: center; gap: 4px;">
                    <img src="/assets/items/Bag_Pok%C3%A9_Ball_Sprite.png" style="filter: grayscale(1);">
                    <span><?=$pokeballs?></span>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex gap-2">
                    <?php if ($wildPokemon->encounters->walking) : ?>
                        <a href="/<?=$instanceId?>/track-pokemon/walking" class="flex-fill btn btn-primary btn-lg <?=$canEncounter ? "" : "disabled"?>">
                            <i class="fas fa-fw fa-shoe-prints"></i>
                        </a>
                    <?php endif ?>
                    <?php if ($wildPokemon->encounters->surfing) : ?>
                        <a href="/<?=$instanceId?>/track-pokemon/surfing" class="flex-fill btn btn-primary btn-lg <?=$canEncounter ? "" : "disabled"?>">
                            <i class="fas fa-fw fa-water"></i>
                        </a>
                    <?php endif ?>
                    <?php if ($wildPokemon->encounters->fishing) : ?>
                        <a href="/<?=$instanceId?>/track-pokemon/fishing" class="flex-fill btn btn-primary btn-lg <?=$canEncounter ? "" : "disabled"?>">
                            <i class="fas fa-fw fa-fish"></i>
                        </a>
                    <?php endif ?>
                    <?php if ($wildPokemon->encounters->rockSmash) : ?>
                        <a href="/<?=$instanceId?>/track-pokemon/rockSmash" class="flex-fill btn btn-primary btn-lg <?=$canEncounter ? "" : "disabled"?>">
                            <i class="fab fa-fw fa-sith"></i>
                        </a>
                    <?php endif ?>
                    <?php if ($wildPokemon->encounters->headbutt) : ?>
                        <a href="/<?=$instanceId?>/track-pokemon/headbutt" class="flex-fill btn btn-primary btn-lg <?=$canEncounter ? "" : "disabled"?>">
                            <i class="fas fa-fw fa-tree"></i>
                        </a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php endif ?>

    <?php if (count($trainers) > 0) : ?>

        <div class="card js-trainers-block">
            <div class="card-header d-flex justify-content-between">
                <div><strong>Trainers</strong></div>
                <div class="d-flex" style="text-align: center; gap: 4px;">
                    <img src="/assets/items/Bag_Contest_Pass_Sprite.png">
                    <span><?=$challengeTokens?></span>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($trainers as $trainer) : ?>
                    <li class="list-group-item d-flex align-items-start">
                        <div class="me-2" style="width: 80px;">
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
                                <small><?=$trainer->party?> Pokémon</small>
                                <?php if ($trainer->isGymLeader) : ?>
                                    <small>&middot; <?=$trainer->leaderBadge?></small>
                                <?php endif ?>
                            </div>
                            <div class="d-flex align-items-center" style="margin-top: 0.4rem;">
                                <form method="POST" action="/<?=$instanceId?>/battle/trainer/<?=$trainer->id?>" style="margin-right: 0.6rem;">
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

    <?php if ($giftPokemon) : ?>

        <div class="card js-legendary-block">
            <div class="card-header d-flex justify-content-between">
                <div><strong>Pokémon</strong></div>
                <div class="d-flex" style="text-align: center; gap: 4px;">
                    <img src="/assets/items/Bag_Oval_Charm_Sprite.png">
                    <span><?=$ovalCharms?></span>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($giftPokemon as $giftPokemonEntry) : ?>
                    <li class="list-group-item d-flex align-items-start">
                        <div class="pokemon-image">
                            <img src="<?=$giftPokemonEntry->imageUrl?>">
                        </div>
                        <div>
                            <div>
                                <strong>
                                    <?=$giftPokemonEntry->name?>
                                </strong>
                            </div>
                            <div>
                                <small>Lv <?=$giftPokemonEntry->level?></small>
                            </div>
                            <div class="d-flex align-items-center" style="margin-top: 0.4rem;">
                                <form method="POST" action="/<?=$instanceId?>/obtain" style="margin-right: 0.6rem;">
                                    <input type="hidden" name="pokedexNumber" value="<?=$giftPokemonEntry->number?>">
                                    <button type="submit" class="btn btn-outline-dark btn-sm" <?=$giftPokemonEntry->canObtain ? "" : "disabled"?>>Obtain</button>
                                </form>
                                <?php if ($giftPokemonEntry->lastObtained) : ?>
                                    <span style="font-size: 0.8rem;">Last obtained <?=$giftPokemonEntry->lastObtained?></span>
                                <?php endif ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>

    <?php endif ?>

    <?php if ($legendary) : ?>

        <div class="card js-legendary-block">
            <div class="card-header d-flex justify-content-between">
                <div><strong>Legendary Encounter</strong></div>
                <div class="d-flex" style="text-align: center; gap: 4px;">
                    <img src="/assets/items/Bag_Oval_Charm_Sprite.png">
                    <span><?=$ovalCharms?></span>
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
                            <form method="POST" action="/<?=$instanceId?>/encounter" style="margin-right: 0.6rem;">
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

        <div class="card js-elite-four-block">
            <div class="card-header d-flex justify-content-between">
                <div><strong>Elite Four</strong></div>
                <div class="d-flex" style="text-align: center; gap: 4px;">
                    <img src="/assets/items/Bag_Contest_Pass_Sprite.png">
                    <span><?=$challengeTokens?></span>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex flex-column">
                    <div class="d-flex justify-content-center w-100">
                        <?php foreach ($eliteFour->memberImageUrls as $memberImageUrl) : ?>
                            <div class="me-2" style="width: 80px;">
                                <img src="<?=$memberImageUrl?>">
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div class="d-flex justify-content-center w-100 mt-3 mb-2">
                        <form method="POST" action="/<?=$instanceId?>/challenge/elite-four/<?=$eliteFour->region?>">
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

<script>
    document.querySelectorAll(".js-encounter-link").forEach(function (el) {
        el.addEventListener("click", function (e) {
            e.preventDefault();
            document.querySelector(".js-encounter-block").scrollIntoView({
                block: 'center'
            });
        })
    });

    document.querySelectorAll(".js-trainers-link").forEach(function (el) {
        el.addEventListener("click", function (e) {
            e.preventDefault();
            document.querySelector(".js-trainers-block").scrollIntoView({
                block: 'center'
            });
        })
    });

    document.querySelectorAll(".js-legendary-link").forEach(function (el) {
        el.addEventListener("click", function (e) {
            e.preventDefault();
            document.querySelector(".js-legendary-block").scrollIntoView({
                block: 'center'
            });
        })
    });

    document.querySelectorAll(".js-elite-four-link").forEach(function (el) {
        el.addEventListener("click", function (e) {
            e.preventDefault();
            document.querySelector(".js-elite-four-block").scrollIntoView({
                block: 'center'
            });
        })
    });
</script>
