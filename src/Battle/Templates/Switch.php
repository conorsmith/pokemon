<h1 style="text-align: center;">Switch Pokémon</h1>

<ul class="list-group" style="margin-top: 2rem; margin-bottom: 2rem;">
    <?php foreach ($team as $pokemon) : ?>
        <li class="list-group-item d-flex" data-target-id="<?=$pokemon->id?>">
            <div class="pokemon-image <?=$pokemon->isShiny ? "pokemon-image--shiny" : ""?> <?=$pokemon->hasFainted ? "slid-down" : ""?>">
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
                    <span class="js-level" style="margin: 0 0.4rem;">
                    Lv <?=$pokemon->level?>
                </span>
                </div>
                <div>
                    <div class="progress" style="height: 2px;">
                        <div class="progress-bar" style="width: <?=$pokemon->remainingHp / $pokemon->totalHp * 100?>%;"></div>
                    </div>
                    <div style="font-size: 0.8rem;"><span class="js-remaining-hp"><?=$pokemon->remainingHp?></span> / <span class="js-total-hp"><?=$pokemon->totalHp?></span> HP</div>
                </div>
            </div>
        </li>
        <li class="list-group-item d-flex justify-content-end" style="background: #fafafa;">
            <div class="d-flex gap-2">
                <form method="POST">
                    <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                    <input type="hidden" name="redirectUrl" value="<?=$redirectUrl?>">
                    <button type="submit" class="btn btn-outline-dark btn-sm" <?=$pokemon->hasFainted ? "disabled" : "" ?>>Switch</button>
                </form>
            </div>
        </li>
    <?php endforeach ?>
    <li class="list-group-item d-grid gap-2" style="text-align: center;">
        <a href="<?=$redirectUrl?>" class="btn btn-outline-dark">
            Cancel
        </a>
    </li>
</ul>
