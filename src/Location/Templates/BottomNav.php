<nav class="navbar fixed-bottom bg-light">
    <div class="container-fluid">
        <div class="d-flex w-100 gap-2" style="min-height: 40px;">
            <a href="/<?=$instanceId?>/map" class="navbar-toggler" type="button">
                <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: middle;">
                    <img src="/assets/items/Bag_Town_Map_Sprite.png">
                </span>
            </a>
            <?php if ($currentLocation->hasWildPokemon) : ?>
                <a href="/<?=$instanceId?>/map/wild-encounters" class="navbar-toggler" type="button">
                    <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: middle;">
                        <img src="/assets/items/Bag_Pok%C3%A9_Ball_Sprite.png" style="filter: grayscale(1);">
                    </span>
                </a>
            <?php endif ?>
            <?php if ($currentLocation->hasTrainers) : ?>
                <a href="/<?=$instanceId?>/map" class="navbar-toggler" type="button">
                    <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: middle;">
                        <img src="/assets/items/Bag_Contest_Pass_Sprite.png">
                    </span>
                </a>
            <?php endif ?>
            <?php if ($currentLocation->hasGiftPokemon) : ?>
                <a href="/<?=$instanceId?>/map" class="navbar-toggler" type="button">
                    <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: middle;">
                        <img src="/assets/items/Bag_Pok%C3%A9_Doll_Sprite.png">
                    </span>
                </a>
            <?php endif ?>
            <?php if ($currentLocation->hasLegendaryPokemon) : ?>
                <a href="/<?=$instanceId?>/map" class="navbar-toggler" type="button">
                    <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: middle;">
                        <img src="/assets/items/Bag_Star_Piece_Sprite.png">
                    </span>
                </a>
            <?php endif ?>
            <?php if ($currentLocation->hasEliteFour) : ?>
                <a href="/<?=$instanceId?>/map" class="navbar-toggler" type="button">
                    <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: middle;">
                        <img src="/assets/items/Bag_Contest_Pass_Sprite.png">
                    </span>
                </a>
            <?php endif ?>
        </div>
    </div>
</nav>
