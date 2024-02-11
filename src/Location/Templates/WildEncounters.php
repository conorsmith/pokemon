<?php include __DIR__ . "/BottomNav.php" ?>

<div class="d-grid gap-4">

    <div class="d-flex justify-content-between align-items-end">
        <h2 class="mb-0"><?=$currentLocation->name?></h2>
        <div>
            <span class="badge bg-secondary"><?=$currentLocation->region?></span>
        </div>
    </div>

    <?php if ($hasWildEncounters) : ?>

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div><strong>Wild Pokémon</strong></div>
                <div class="d-flex" style="text-align: center; gap: 4px;">
                    <img src="/assets/items/Bag_Pok%C3%A9_Ball_Sprite.png" style="filter: grayscale(1);">
                    <span><?=$pokeballs?></span>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex gap-2">
                    <?php if ($wildEncounters->walking) : ?>
                        <a href="/<?=$instanceId?>/track-pokemon/walking" class="flex-fill btn btn-primary btn-lg <?=$canEncounter ? "" : "disabled"?>">
                            <i class="fas fa-fw fa-shoe-prints"></i>
                        </a>
                    <?php endif ?>
                    <?php if ($wildEncounters->surfing) : ?>
                        <a href="/<?=$instanceId?>/track-pokemon/surfing" class="flex-fill btn btn-primary btn-lg <?=$canEncounter ? "" : "disabled"?>">
                            <i class="fas fa-fw fa-water"></i>
                        </a>
                    <?php endif ?>
                    <?php if ($wildEncounters->fishing) : ?>
                        <a href="/<?=$instanceId?>/track-pokemon/fishing" class="flex-fill btn btn-primary btn-lg <?=$canEncounter ? "" : "disabled"?>">
                            <i class="fas fa-fw fa-fish"></i>
                        </a>
                    <?php endif ?>
                    <?php if ($wildEncounters->rockSmash) : ?>
                        <a href="/<?=$instanceId?>/track-pokemon/rockSmash" class="flex-fill btn btn-primary btn-lg <?=$canEncounter ? "" : "disabled"?>">
                            <i class="fab fa-fw fa-sith"></i>
                        </a>
                    <?php endif ?>
                    <?php if ($wildEncounters->headbutt) : ?>
                        <a href="/<?=$instanceId?>/track-pokemon/headbutt" class="flex-fill btn btn-primary btn-lg <?=$canEncounter ? "" : "disabled"?>">
                            <i class="fas fa-fw fa-tree"></i>
                        </a>
                    <?php endif ?>
                </div>
            </div>
        </div>

    <?php endif ?>

    <?php if ($hasGiftPokemon) : ?>

        <div class="card">
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

</div>
