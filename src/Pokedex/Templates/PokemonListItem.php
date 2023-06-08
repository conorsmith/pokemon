<div class="pokemon-image">
    <img src="<?=$pokemon->imageUrl?>">
</div>
<div class="flex-grow-1">
    <h5>
        <span style="color: #888;">#<?=$pokemon->pokedexNumber?></span>
        <?=$pokemon->name?>
    </h5>
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
    </p>
</div>
