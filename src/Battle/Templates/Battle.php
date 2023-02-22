<?php foreach ($errors as $error) : ?>
    <div class="alert alert-danger"><?=$error?></div>
<?php endforeach ?>

<ul class="list-group" style="margin-top: 2rem; margin-bottom: 2rem;">
    <li class="list-group-item" style="text-align: center;">
        <div><strong><?=$trainer->name?></strong></div>
        <div>
            <?php for ($i = 0; $i < $trainer->team->fainted; $i++) : ?>
                <i class="far fa-circle"></i>
            <?php endfor ?>
            <?php for ($i = 0; $i < $trainer->team->active; $i++) : ?>
                <i class="fas fa-circle"></i>
            <?php endfor ?>
        </div>
    </li>
    <li class="list-group-item d-flex flex-row-reverse">
        <div class="pokemon-image <?=$activePokemon->isShiny ? "pokemon-image--shiny" : ""?>">
            <img src="<?=$activePokemon->imageUrl?>">
        </div>
        <div style="text-align: right; flex-grow: 1;">
            <h5><?=$activePokemon->name?></h5>
            <div class="mb-3 d-flex flex-row-reverse">
                <span>
                    <span class="badge bg-<?=$activePokemon->primaryType?>" style="text-transform: uppercase;">
                        <?=$activePokemon->primaryType?>
                    </span>
                    <?php if ($activePokemon->secondaryType) : ?>
                        <span class="badge bg-<?=$activePokemon->secondaryType?>" style="text-transform: uppercase;">
                            <?=$activePokemon->secondaryType?>
                        </span>
                    <?php endif ?>
                </span>
                <span style="margin: 0 0.4rem;">
                    Level <?=$activePokemon->level?>
                </span>
            </div>
            <div>
                <div class="progress justify-content-end" style="height: 2px;">
                    <div class="progress-bar" style="width: <?=$activePokemon->remainingHp / $activePokemon->totalHp * 100?>%;"></div>
                </div>
                <div style="font-size: 0.8rem;"><?=$activePokemon->remainingHp?> / <?=$activePokemon->totalHp?> HP</div>
            </div>
        </div>
    </li>
    <li class="list-group-item d-flex">
        <div class="pokemon-image <?=$leadPokemon->isShiny ? "pokemon-image--shiny" : ""?>">
            <img src="<?=$leadPokemon->imageUrl?>">
        </div>
        <div style="flex-grow: 1">
            <h5><?=$leadPokemon->name?></h5>
            <div class="mb-3">
                <span>
                    <span class="badge bg-<?=$leadPokemon->primaryType?>" style="text-transform: uppercase;">
                        <?=$leadPokemon->primaryType?>
                    </span>
                    <?php if ($leadPokemon->secondaryType) : ?>
                        <span class="badge bg-<?=$leadPokemon->secondaryType?>" style="text-transform: uppercase;">
                            <?=$leadPokemon->secondaryType?>
                        </span>
                    <?php endif ?>
                </span>
                <span style="margin: 0 0.4rem;">
                    Level <?=$leadPokemon->level?>
                </span>
            </div>
            <div>
                <div class="progress" style="height: 2px;">
                    <div class="progress-bar" style="width: <?=$leadPokemon->remainingHp / $leadPokemon->totalHp * 100?>%;"></div>
                </div>
                <div style="font-size: 0.8rem;"><?=$leadPokemon->remainingHp?> / <?=$leadPokemon->totalHp?> HP</div>
            </div>
        </div>
    </li>
    <?php if ($successes) : ?>
        <li class="list-group-item">
            <ul>
                <?php foreach ($successes as $success) : ?>
                    <li><?=$success?></li>
                <?php endforeach ?>
            </ul>
        </li>
    <?php endif ?>
    <li class="list-group-item d-grid gap-2" style="text-align: center;">
        <?php if ($isBattleOver) : ?>
            <form method="POST" action="/battle/<?=$id?>/finish" class="d-grid">
                <button type="submit" class="btn btn-outline-dark">
                    Finish
                </button>
            </form>
        <?php else : ?>
            <form method="POST" action="/battle/<?=$id?>/fight" class="d-grid">
                <button type="submit" class="btn btn-primary">
                    Fight
                </button>
            </form>
            <a href="/battle/<?=$id?>/switch" class="btn btn-outline-dark">
                Switch
            </a>
        <?php endif ?>
    </li>
</ul>
