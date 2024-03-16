<?php require __DIR__ . "/BattleScript.php" ?>

<style>
    .battle-panel {
        position: relative;
        padding: 0.6rem 1.2rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        background-color: #fff;
    }
</style>

<div class="d-flex flex-column align-items-stretch" style="position: absolute; top: 56px; left: 0; right: 0; bottom: 0;">

<div>
    <div class="battle-panel d-flex justify-content-between">
        <div>
            <div><strong><?=$trainer->name?></strong></div>
            <div class="js-trainer-party">
                <?php for ($i = 0; $i < $trainer->party->fainted; $i++) : ?>
                    <i class="far fa-circle"></i>
                <?php endfor ?>
                <?php for ($i = 0; $i < $trainer->party->active; $i++) : ?>
                    <i class="fas fa-circle"></i>
                <?php endfor ?>
            </div>
        </div>
        <div>
            <img src="<?=$trainer->imageUrl?>">
        </div>
    </div>
    <div class="battle-panel d-flex flex-row-reverse" data-target-id="<?=$opponentPokemon->id?>">
        <div class="pokemon-image <?=$opponentPokemon->isShiny ? "pokemon-image--shiny" : ""?> <?=$opponentPokemon->hasFainted ? "slid-down" : ""?>">
            <img src="<?=$opponentPokemon->imageUrl?>">
        </div>
        <div style="text-align: right; flex-grow: 1;">
            <h5>
                <span class="js-name"><?=$opponentPokemon->name?></span>
                <span class="js-sex pokemon-sex">
                    <?php if ($opponentPokemon->sex === \ConorSmith\Pokemon\SharedKernel\Domain\Sex::FEMALE) : ?>
                        <i class="fas fa-venus"></i>
                    <?php elseif ($opponentPokemon->sex === \ConorSmith\Pokemon\SharedKernel\Domain\Sex::MALE) : ?>
                        <i class="fas fa-mars"></i>
                    <?php elseif ($opponentPokemon->sex === \ConorSmith\Pokemon\SharedKernel\Domain\Sex::UNKNOWN) : ?>
                        <i class="fas fa-genderless"></i>
                    <?php endif ?>
                </span>
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
    </div>
    <div class="battle-panel d-flex" data-target-id="<?=$playerPokemon->id?>">
        <div class="pokemon-image <?=$playerPokemon->isShiny ? "pokemon-image--shiny" : ""?> <?=$playerPokemon->hasFainted ? "slid-down" : ""?>">
            <img src="<?=$playerPokemon->imageUrl?>">
        </div>
        <div style="flex-grow: 1">
            <h5>
                <span class="js-name"><?=$playerPokemon->name?></span>
                <span class="js-sex pokemon-sex">
                    <?php if ($playerPokemon->sex === \ConorSmith\Pokemon\SharedKernel\Domain\Sex::FEMALE) : ?>
                        <i class="fas fa-venus"></i>
                    <?php elseif ($playerPokemon->sex === \ConorSmith\Pokemon\SharedKernel\Domain\Sex::MALE) : ?>
                        <i class="fas fa-mars"></i>
                    <?php elseif ($playerPokemon->sex === \ConorSmith\Pokemon\SharedKernel\Domain\Sex::UNKNOWN) : ?>
                        <i class="fas fa-genderless"></i>
                    <?php endif ?>
                </span>
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
    </div>
</div>

<div id="messages" class="battle-panel flex-grow-1" style="overflow-y: auto;">
    <ul style="margin-bottom: 0;"></ul>
</div>

<div class="battle-panel d-grid gap-2 js-interaction-container" style="text-align: center;">
    <form method="POST" action="/<?=$instanceId?>/battle/<?=$id?>/finish" class="d-grid <?=$isBattleOver ? "" : "d-none"?>">
        <button type="submit" class="btn btn-outline-dark js-interaction">
            Finish
        </button>
    </form>
    <?php $mode = "battle" ?>
    <?php require __DIR__ . "/ButtonsAttack.php" ?>
    <a href="/<?=$instanceId?>/party/switch?redirect=<?=urlencode("/{$instanceId}/battle/{$id}")?>" class="btn btn-outline-dark js-interaction <?=$isBattleOver ? "d-none" : ""?>">
        Switch
    </a>
</div>
