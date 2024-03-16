<div class="d-flex justify-content-between align-items-end">
    <h2 class="mb-0">Switch</h2>
    <a href="<?=$redirectUrl?>" class="btn btn-sm btn-outline-dark">Back</a>
</div>

<ul class="list-group" style="margin-top: 2rem; margin-bottom: 2rem;">
    <?php foreach ($party as $member) : ?>
        <li class="list-group-item d-flex" data-target-id="<?=$member->pokemon->id?>">
            <div class="pokemon-image <?=$member->pokemon->isShiny ? "pokemon-image--shiny" : ""?> <?=$member->pokemon->hasFainted ? "slid-down" : ""?>">
                <img src="<?=$member->pokemon->imageUrl?>">
            </div>
            <div style="flex-grow: 1">
                <h5><?=$member->pokemon->name?></h5>
                <div class="mb-3">
                <span class="js-types">
                    <span class="badge bg-<?=$member->pokemon->primaryType?>" style="text-transform: uppercase;">
                        <?=$member->pokemon->primaryType?>
                    </span>
                    <?php if ($member->pokemon->secondaryType) : ?>
                        <span class="badge bg-<?=$member->pokemon->secondaryType?>" style="text-transform: uppercase;">
                            <?=$member->pokemon->secondaryType?>
                        </span>
                    <?php endif ?>
                </span>
                    <span class="js-level pokemon-level">
                    Lv <?=$member->pokemon->level?>
                </span>
                </div>
                <div>
                    <div class="progress" style="height: 2px;">
                        <div class="progress-bar" style="width: <?=$member->pokemon->remainingHp / $member->pokemon->totalHp * 100?>%;"></div>
                    </div>
                    <div style="font-size: 0.8rem;"><span class="js-remaining-hp"><?=$member->pokemon->remainingHp?></span> / <span class="js-total-hp"><?=$member->pokemon->totalHp?></span> HP</div>
                </div>
            </div>
        </li>
        <li class="list-group-item d-flex justify-content-end" style="background: #fafafa;">
            <div class="d-flex gap-2">
                <form method="POST">
                    <input type="hidden" name="pokemon" value="<?=$member->pokemon->id?>">
                    <input type="hidden" name="redirectUrl" value="<?=$redirectUrl?>">
                    <button type="submit" class="btn btn-outline-dark btn-sm" <?=$member->pokemon->hasFainted ? "disabled" : "" ?>>Switch</button>
                </form>
            </div>
        </li>
    <?php endforeach ?>
</ul>
