<div class="d-flex justify-content-between align-items-end">
    <h2 class="mb-0">Hall of Fame</h2>
    <a href="/<?=$instanceId?>/map" class="btn btn-sm btn-outline-dark">Back</a>
</div>

<?php foreach ($hallOfFameEntries as $hallOfFameEntry) : ?>
    <div class="card" style="margin-top: 2rem;">
        <div class="card-header d-flex justify-content-between">
            <div><strong><?=$hallOfFameEntry->name?></strong></div>
            <div><?=$hallOfFameEntry->date?></div>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($hallOfFameEntry->team as $pokemon) : ?>
                <li class="list-group-item d-flex">
                    <div class="pokemon-image <?=$pokemon->isShiny ? "pokemon-image--shiny" : ""?>">
                        <img src="<?=$pokemon->imageUrl?>">
                    </div>
                    <div style="flex-grow: 1">
                        <h5><?=$pokemon->name?></h5>
                        <div class="mb-3">
                            <span class="js-types">
                                <span class="badge bg-<?=$pokemon->primaryType?>" style="text-transform: uppercase;">
                                    <?=$pokemon->primaryType?>
                                </span>
                                <?php if ($pokemon->secondaryType) : ?>
                                    <span class="badge bg-<?=$pokemon->secondaryType?>" style="text-transform: uppercase;">
                                        <?=$pokemon->secondaryType?>
                                    </span>
                                <?php endif ?>
                            </span>
                            <span class="js-level pokemon-level">
                            Lv <?=$pokemon->level?>
                        </span>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endforeach ?>
