<li class="list-group-item d-flex flex-column">
    <div class="d-flex">
        <div class="pokemon-image <?=$pokemon->isShiny ? "pokemon-image--shiny" : ""?>">
            <img src="<?=$pokemon->imageUrl?>">
        </div>
        <div class="flex-grow-1">
            <h5>
                <?=$pokemon->name?>
                <span class="pokemon-sex">
                    <i class="fas <?=$pokemon->sexIcon?>"></i>
                </span>
                <?php if ($pokemon->form) : ?>
                    <span class="badge bg-secondary" style="font-size: 0.8rem;"><?=$pokemon->form?> Form</span>
                <?php endif ?>
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
                <span class="pokemon-level">
                    Lv <?=$pokemon->level?>
                </span>
            </p>
            <div class="d-flex align-items-center gap-1" style="margin-top: 0.6rem;">
                <span>
                    <span class="badge badge-eg bg-eg-<?=$pokemon->firstEggGroup?>">
                        <i class="fas fa-egg"></i>
                        <?=$pokemon->firstEggGroup?>
                    </span>
                    <?php if ($pokemon->secondEggGroup) : ?>
                        <span class="badge badge-eg bg-eg-<?=$pokemon->secondEggGroup?>">
                            <i class="fas fa-egg"></i>
                            <?=$pokemon->secondEggGroup?>
                        </span>
                    <?php endif ?>
                </span>
            </div>
        </div>
    </div>
    <div class="pokemon-stats" style="margin-top: 0.4rem; display: grid; grid-template-columns: repeat(6, 1fr); grid-auto-rows: 1fr; align-items: stretch; grid-column-gap: 0.4rem; grid-row-gap: 0.4rem;">
        <div class="d-flex flex-column align-items-center">
            <i class="fa-fw fas fa-paw"></i>
            <span class="stat <?=$pokemon->stats->physicalAttack->ivDeviation->class?>"><?=$pokemon->stats->physicalAttack->ivDeviation->value?></span>
        </div>
        <div class="d-flex flex-column align-items-center">
            <i class="fa-fw fas fa-wifi"></i>
            <span class="stat <?=$pokemon->stats->specialAttack->ivDeviation->class?>"><?=$pokemon->stats->specialAttack->ivDeviation->value?></span>
        </div>
        <div class="d-flex flex-column align-items-center">
            <i class="fa-fw fas fa-shield-alt"></i>
            <span class="stat <?=$pokemon->stats->physicalDefence->ivDeviation->class?>"><?=$pokemon->stats->physicalDefence->ivDeviation->value?></span>
        </div>
        <div class="d-flex flex-column align-items-center">
            <i class="fa-fw fas fa-expand"></i>
            <span class="stat <?=$pokemon->stats->specialDefence->ivDeviation->class?>"><?=$pokemon->stats->specialDefence->ivDeviation->value?></span>
        </div>
        <div class="d-flex flex-column align-items-center">
            <i class="fa-fw fas fa-wind"></i>
            <span class="stat <?=$pokemon->stats->speed->ivDeviation->class?>"><?=$pokemon->stats->speed->ivDeviation->value?></span>
        </div>
        <div class="d-flex flex-column align-items-center">
            <i class="fa-fw fas fa-heartbeat"></i>
            <span class="stat <?=$pokemon->stats->hp->ivDeviation->class?>"><?=$pokemon->stats->hp->ivDeviation->value?></span>
        </div>
    </div>
    <a href="/<?=$instanceId?>/party/member/<?=$pokemon->id?>" data-id="<?=$pokemon->id?>" class="stretched-link stretched-link--hidden">Go to Stats</a>
</li>
