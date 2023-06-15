<li class="list-group-item d-flex">
    <div class="pokemon-image pokemon-image-sm">
        <img src="<?=$pokemon->imageUrl?>">
    </div>
    <div class="flex-grow-1">
        <div class="d-flex justify-content-between">
            <div class="d-flex justify-content-start gap-2">
                <div style="color: #888; width: 2rem; text-align: right;">#<?=$pokemon->pokedexNumber?></div>
                <div style="font-weight: 500;"><?=$pokemon->name?></div>
            </div>
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
    </div>
</li>
<li class="list-group-item d-grid" style="background-color: #fafafa; grid-template-columns: repeat(7, minmax(0, 1fr));">
    <div class="stat <?=$query->sort === "hp" ? "stat--selected" : ""?>"><?=$pokemon->stats->hp?></div>
    <div class="stat <?=$query->sort === "pa" ? "stat--selected" : ""?>"><?=$pokemon->stats->physicalAttack?></div>
    <div class="stat <?=$query->sort === "sa" ? "stat--selected" : ""?>"><?=$pokemon->stats->specialAttack?></div>
    <div class="stat <?=$query->sort === "pd" ? "stat--selected" : ""?>"><?=$pokemon->stats->physicalDefence?></div>
    <div class="stat <?=$query->sort === "sd" ? "stat--selected" : ""?>"><?=$pokemon->stats->specialDefence?></div>
    <div class="stat <?=$query->sort === "sp" ? "stat--selected" : ""?>"><?=$pokemon->stats->speed?></div>
    <div class="stat <?=$query->sort === "total" ? "stat--selected" : ""?>" style="text-decoration: underline;"><?=$pokemon->stats->total?></div>
</li>
