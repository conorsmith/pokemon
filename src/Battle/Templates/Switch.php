<h1 style="text-align: center;">Switch</h1>

<ul class="list-group" style="margin-top: 2rem; margin-bottom: 2rem;">
    <?php foreach ($team as $pokemon) : ?>
        <li class="list-group-item d-flex">
            <div class="pokemon-image <?=$pokemon->isShiny ? "pokemon-image--shiny" : ""?>">
                <img src="<?=$pokemon->imageUrl?>">
            </div>
            <div class="w-100">
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
                    Level <?=$pokemon->level?>
                </span>
                </p>
                <div class="d-flex justify-content-end">
                    <form method="POST">
                        <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                        <input type="hidden" name="redirectUrl" value="<?=$redirectUrl?>">
                        <button type="submit" class="btn btn-outline-dark btn-sm">Switch</button>
                    </form>
                </div>
            </div>
        </li>
    <?php endforeach ?>
    <li class="list-group-item d-grid gap-2" style="text-align: center;">
        <a href="<?=$redirectUrl?>" class="btn btn-outline-dark">
            Cancel
        </a>
    </li>
</ul>
