<?php require __DIR__ . "/BattleScript.php" ?>

<ul class="list-group">
    <li class="list-group-item d-flex justify-content-between">
        <div>
            <div><strong><?=$trainer->name?></strong></div>
            <div class="js-trainer-team">
                <?php for ($i = 0; $i < $trainer->team->fainted; $i++) : ?>
                    <i class="far fa-circle"></i>
                <?php endfor ?>
                <?php for ($i = 0; $i < $trainer->team->active; $i++) : ?>
                    <i class="fas fa-circle"></i>
                <?php endfor ?>
            </div>
        </div>
        <div>
            <img src="<?=$trainer->imageUrl?>">
        </div>
    </li>
    <li class="list-group-item d-flex flex-row-reverse" data-target-id="<?=$opponentPokemon->id?>">
        <div class="pokemon-image <?=$opponentPokemon->isShiny ? "pokemon-image--shiny" : ""?> <?=$opponentPokemon->hasFainted ? "slid-down" : ""?>">
            <img src="<?=$opponentPokemon->imageUrl?>">
        </div>
        <div style="text-align: right; flex-grow: 1;">
            <h5>
                <?=$opponentPokemon->name?>
                <?php if ($opponentPokemon->form) : ?>
                    <span class="badge bg-secondary" style="font-size: 0.8rem;"><?=$opponentPokemon->form?> Form</span>
                <?php endif ?>
            </h5>
            <div class="mb-3 d-flex flex-row-reverse">
                <span class="js-types">
                    <span class="badge bg-<?=$opponentPokemon->primaryType?>" style="text-transform: uppercase;">
                        <?=$opponentPokemon->primaryType?>
                    </span>
                    <?php if ($opponentPokemon->secondaryType) : ?>
                        <span class="badge bg-<?=$opponentPokemon->secondaryType?>" style="text-transform: uppercase;">
                            <?=$opponentPokemon->secondaryType?>
                        </span>
                    <?php endif ?>
                </span>
                <span class="js-level" style="margin: 0 0.4rem;">
                    Lv <?=$opponentPokemon->level?>
                </span>
            </div>
            <div>
                <div class="progress justify-content-end" style="height: 2px;">
                    <div class="progress-bar" style="width: <?=$opponentPokemon->remainingHp / $opponentPokemon->totalHp * 100?>%;"></div>
                </div>
                <div style="font-size: 0.8rem;"><span class="js-remaining-hp"><?=$opponentPokemon->remainingHp?></span> / <span class="js-total-hp"><?=$opponentPokemon->totalHp?></span> HP</div>
            </div>
        </div>
    </li>
    <li class="list-group-item d-flex" data-target-id="<?=$playerPokemon->id?>">
        <div class="pokemon-image <?=$playerPokemon->isShiny ? "pokemon-image--shiny" : ""?> <?=$playerPokemon->hasFainted ? "slid-down" : ""?>">
            <img src="<?=$playerPokemon->imageUrl?>">
        </div>
        <div style="flex-grow: 1">
            <h5>
                <?=$playerPokemon->name?>
                <?php if ($playerPokemon->form) : ?>
                    <span class="badge bg-secondary" style="font-size: 0.8rem;"><?=$playerPokemon->form?> Form</span>
                <?php endif ?>
            </h5>
            <div class="mb-3">
                <span class="js-types">
                    <span class="badge bg-<?=$playerPokemon->primaryType?>" style="text-transform: uppercase;">
                        <?=$playerPokemon->primaryType?>
                    </span>
                    <?php if ($playerPokemon->secondaryType) : ?>
                        <span class="badge bg-<?=$playerPokemon->secondaryType?>" style="text-transform: uppercase;">
                            <?=$playerPokemon->secondaryType?>
                        </span>
                    <?php endif ?>
                </span>
                <span class="js-level" style="margin: 0 0.4rem;">
                    Lv <?=$playerPokemon->level?>
                </span>
            </div>
            <div>
                <div class="progress" style="height: 2px;">
                    <div class="progress-bar" style="width: <?=$playerPokemon->remainingHp / $playerPokemon->totalHp * 100?>%;"></div>
                </div>
                <div style="font-size: 0.8rem;"><span class="js-remaining-hp"><?=$playerPokemon->remainingHp?></span> / <span class="js-total-hp"><?=$playerPokemon->totalHp?></span> HP</div>
            </div>
        </div>
    </li>
    <li id="messages" class="list-group-item" style="display: none;">
        <ul>
        </ul>
    </li>
    <li class="list-group-item d-grid gap-2 js-interaction-container" style="text-align: center;">
        <form method="POST" action="/battle/<?=$id?>/finish" class="d-grid <?=$isBattleOver ? "" : "d-none"?>">
            <button type="submit" class="btn btn-outline-dark js-interaction">
                Finish
            </button>
        </form>
        <?php $mode = "battle" ?>
        <?php require __DIR__ . "/ButtonsAttack.php" ?>
        <a href="/team/switch?redirect=<?=urlencode("/battle/{$id}")?>" class="btn btn-outline-dark js-interaction <?=$isBattleOver ? "d-none" : ""?>">
            Switch
        </a>
    </li>
</ul>
