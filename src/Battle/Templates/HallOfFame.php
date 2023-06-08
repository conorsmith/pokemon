<h2>Hall of Fame</h2>

<ul class="list-group" style="margin-top: 2rem; margin-bottom: 2rem;">
    <?php foreach ($team as $pokemon) : ?>
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
