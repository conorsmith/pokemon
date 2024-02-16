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
                <div class="d-flex flex-column gap-2">
                    <?php foreach ($wildEncounters as $wildEncounter) : ?>
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa-fw <?=$wildEncounter->classes?>" style="font-size: 1.5rem;"></i>
                            <a href="/<?=$instanceId?>/track-pokemon/<?=$wildEncounter->encounterType?>" class="flex-fill btn btn-outline-dark <?=$canEncounter ? "" : "disabled"?>">
                                Track
                            </a>
                            <a href="/<?=$instanceId?>/survey-pokemon/<?=$wildEncounter->encounterType?>" class="btn <?=$wildEncounter->surveyComplete ? "btn-success" : ($wildEncounter->surveyStarted ? "btn-warning" : "btn-outline-dark") ?>  <?=$canEncounter ? "" : "disabled"?>">
                                Survey
                            </a>
                        </div>
                    <?php endforeach ?>
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
