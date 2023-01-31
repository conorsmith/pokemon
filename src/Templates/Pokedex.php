<div class="d-grid gap-4">

    <h1 style="text-align: center;">Pokédex</h1>

    <ul class="list-group">

        <li class="list-group-item p-3" style="text-align: center;">
            <strong><?=$count?></strong> entries
        </li>

        <?php foreach ($pokedex as $number => $pokemon) : ?>
            <li class="list-group-item d-flex">
                <?php if ($pokemon) : ?>
                    <div class="pokemon-image">
                        <img src="<?=$pokemon->imageUrl?>">
                    </div>
                    <div class="flex-grow-1">
                        <h5>
                            <span style="color: #888;">#<?=$number?></span>
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
                <?php else : ?>
                    <div class="d-flex align-items-center justify-content-center" style="width: 6rem; height: 5rem; margin-right: 1rem; color: #aaa;">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div>
                        <h5><span style="color: #aaa;">#<?=$number?></span></h5>
                        <p class="mb-0">
                            <span class="badge" style="text-transform: uppercase; background-color: #aaa; color: #fff;">
                                ???
                            </span>
                        </p>
                    </div>
                <?php endif ?>
            </li>
        <?php endforeach ?>
    </ul>

</div>
