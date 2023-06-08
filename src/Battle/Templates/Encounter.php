<?php require __DIR__ . "/BattleScript.php" ?>

<ul class="list-group">
    <li class="list-group-item" style="text-align: center;">
        <?php if ($isLegendary) : ?>
            <strong>You encounter the legendary Pokémon <?=$opponentPokemon->name?></strong>
        <?php else : ?>
            <strong>You encounter a wild <?=$opponentPokemon->name?></strong>
        <?php endif ?>
    </li>
    <li class="list-group-item d-flex flex-row-reverse" data-target-id="<?=$opponentPokemon->id?>">
        <div class="pokemon-image pokemon-image--encounter <?=$opponentPokemon->isShiny ? "pokemon-image--shiny" : ""?> <?=$opponentPokemon->hasFainted ? "slid-down" : ""?>">
            <img src="<?=$opponentPokemon->imageUrl?>">
        </div>
        <div style="text-align: right; flex-grow: 1;">
            <h5>
                <?php if ($encounteredPokemonIsRegistered) : ?>
                    <i class="fas fa-fw fa-circle" style="color: #aaa; font-size: 1rem;"></i>
                <?php else : ?>
                    <i class="far fa-fw fa-circle" style="color: #aaa; font-size: 1rem;"></i>
                <?php endif ?>
                <?=$opponentPokemon->name?>
                <?php if ($opponentPokemon->form) : ?>
                    <span class="badge bg-secondary" style="font-size: 0.8rem;"><?=$opponentPokemon->form?> Form</span>
                <?php endif ?>
            </h5>
            <div class="mb-3 d-flex align-items-center flex-row-reverse">
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
                <span class="js-level pokemon-level">
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
                <span class="js-level pokemon-level">
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
        <form method="POST" action="/encounter/<?=$id?>/run" class="d-grid <?=$isBattleOver ? "" : "d-none"?>">
            <button type="submit" class="btn btn-outline-dark js-interaction">
                Finish
            </button>
        </form>
        <?php $mode = "encounter" ?>
        <?php require __DIR__ . "/ButtonsAttack.php" ?>
        <a href="/team/switch?redirect=<?=urlencode("/encounter/{$id}")?>" class="btn btn-outline-dark js-interaction <?=$isBattleOver ? "d-none" : ""?>">
            Switch
        </a>
        <div class="d-flex w-100 gap-2">
            <?php foreach ($pokeballs as $pokeball) : ?>
                <form method="POST" action="/encounter/<?=$id?>/catch" class="d-grid flex-grow-1 js-catch <?=$isBattleOver ? "d-none" : ""?>">
                    <button type="submit" name="pokeball" value="<?=$pokeball->id?>" class="btn btn-outline-primary d-flex justify-content-center align-items-center js-interaction">
                        <div class="me-1">
                            <img src="<?=$pokeball->imageUrl?>">
                        </div>
                        <div>
                            <span class="badge text-bg-primary"><?=$pokeball->amount?></span>
                        </div>
                    </button>
                </form>
            <?php endforeach ?>
        </div>
        <form method="POST" action="/encounter/<?=$id?>/run" class="d-grid <?=$isBattleOver ? "d-none" : ""?>">
            <button type="submit" class="btn btn-outline-secondary js-interaction">Run</button>
        </form>
    </li>
</ul>

<div class="modal js-pokeball-confirmation" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
            </div>
            <div class="modal-body">
                <p>Throw?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary js-pokeball-confirmation-cancel">Cancel</button>
                <button type="button" class="btn btn-primary js-pokeball-confirmation-confirm">Confirm</button>
            </div>
        </div>
    </div>
</div>
