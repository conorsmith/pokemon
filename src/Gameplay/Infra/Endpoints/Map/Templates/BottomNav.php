<nav class="navbar fixed-bottom bg-light">
    <div class="container-fluid">
        <div class="d-flex w-100 gap-2" style="min-height: 40px;">
            <a href="/<?=$instanceId?>/map" class="navbar-toggler" type="button">
                <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: middle;">
                    <img src="/assets/items/Bag_Town_Map_Sprite.png">
                </span>
            </a>
            <?php if ($navigationBar->showPokemon) : ?>
                <a href="/<?=$instanceId?>/map/pokemon" class="navbar-toggler" type="button">
                    <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: middle;">
                        <img src="/assets/items/Bag_Pok%C3%A9_Ball_Sprite.png" style="filter: grayscale(1);">
                    </span>
                </a>
            <?php endif ?>
            <?php if ($navigationBar->showTrainers) : ?>
                <a href="/<?=$instanceId?>/map/trainers" class="navbar-toggler" type="button">
                    <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: middle;">
                        <img src="/assets/items/Bag_Contest_Pass_Sprite.png">
                    </span>
                </a>
            <?php endif ?>
            <?php if ($navigationBar->showEliteFour) : ?>
                <a href="/<?=$instanceId?>/map/elite-four" class="navbar-toggler" type="button">
                    <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: middle;">
                        <img src="/assets/items/Bag_Contest_Pass_Sprite.png">
                    </span>
                </a>
            <?php endif ?>
            <?php if ($navigationBar->showFacilities) : ?>
                <a href="/<?=$instanceId?>/map/facilities" class="navbar-toggler" type="button">
                    <span style="display: inline-block; width: 1.5em; height: 1.5em; vertical-align: middle;">
                        <img src="/assets/items/Bag_Devon_Parts_Sprite.png">
                    </span>
                </a>
            <?php endif ?>
        </div>
    </div>
</nav>
