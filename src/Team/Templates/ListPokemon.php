<li class="list-group-item d-flex">
    <div class="pokemon-image <?=$pokemon->isShiny ? "pokemon-image--shiny" : ""?>">
        <img src="<?=$pokemon->imageUrl?>">
    </div>
    <div class="flex-grow-1">
        <h5><?=$pokemon->name?></h5>
        <p class="mb-0">
            <span>
                <span class="badge bg-<?=$pokemon->primaryType?>" style="text-transform: uppercase;">
                    <?=$pokemon->primaryType?>
                </span>
                <?php if ($pokemon->secondaryType) : ?>
                    <span class="badge bg-<?=$pokemon->secondaryType?>" style="text-transform: uppercase;">
                        <?=$pokemon->secondaryType?>
                    </span>
                <?php endif ?>
            </span>
            <span style="margin: 0 0.4rem;">
                Lv <?=$pokemon->level?>
            </span>
        </p>
        <div class="d-flex align-items-center gap-1" style="margin-top: 0.6rem;">
            <i class="far fa-fw <?=$pokemon->friendshipIcon?>" style="font-size: 1.4rem; color: #666;"></i>
            <?=$pokemon->friendship?>
        </div>
    </div>
</li>
