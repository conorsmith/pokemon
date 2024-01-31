<?php include __DIR__ . "/BottomNav.php" ?>

<div class="d-grid gap-4">

    <div class="d-flex justify-content-between align-items-end">
        <h2 class="mb-0"><?=$currentLocation->name?></h2>
        <div>
            <span class="badge bg-secondary"><?=$currentLocation->region?></span>
        </div>
    </div>

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

</div>
