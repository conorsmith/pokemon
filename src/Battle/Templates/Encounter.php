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
    <div class="battle-panel d-flex flex-row-reverse" data-target-id="<?=$opponentPokemon->id?>" style="border-bottom-width: 0;">
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
    <div class="battle-panel <?=$encounteredPokemonStrengthIndicatorProgress === 0 ? "d-flex" : "d-none" ?> align-items-center gap-2 strength-indicator js-strength-indicator" data-phase="0">
        <div><i class="fa-fw fas fa-dna"></i></div>
        <div class="progress strength-indicator--aggregate">
            <div class="progress-bar bg-warning" style="width:<?=$opponentPokemon->ivs->total * 100?>%"></div>
        </div>
    </div>
    <div class="battle-panel <?=$encounteredPokemonStrengthIndicatorProgress === 1 ? "d-flex" : "d-none" ?> align-items-center gap-2 strength-indicator js-strength-indicator" data-phase="1">
        <div><i class="fa-fw fas fa-dna"></i></div>
        <div class="progress strength-indicator--aggregate">
            <div class="progress-bar bg-warning" style="width:<?=$opponentPokemon->ivs->offensiveTotal * 100?>%"></div>
        </div>
        <div class="progress strength-indicator--aggregate">
            <div class="progress-bar bg-warning" style="width:<?=$opponentPokemon->ivs->defensiveTotal * 100?>%"></div>
        </div>
    </div>
    <div class="battle-panel <?=$encounteredPokemonStrengthIndicatorProgress === 2 ? "d-flex" : "d-none" ?> align-items-center gap-2 strength-indicator js-strength-indicator" data-phase="2">
        <div><i class="fa-fw fas fa-dna"></i></div>
        <div class="progress strength-indicator--aggregate">
            <div class="progress-bar bg-warning" style="width:<?=$opponentPokemon->ivs->attackTotal * 100?>%"></div>
        </div>
        <div class="progress strength-indicator--aggregate">
            <div class="progress-bar bg-warning" style="width:<?=$opponentPokemon->ivs->defenceTotal * 100?>%"></div>
        </div>
        <div><i class="fa-fw fas fa-wind"></i></div>
        <div class="progress">
            <div class="progress-bar bg-warning" style="width:<?=$opponentPokemon->ivs->speed * 100?>%"></div>
        </div>
        <div><i class="fa-fw fas fa-heartbeat"></i></div>
        <div class="progress">
            <div class="progress-bar bg-warning" style="width:<?=$opponentPokemon->ivs->hp * 100?>%"></div>
        </div>
    </div>
    <div class="battle-panel <?=$encounteredPokemonStrengthIndicatorProgress === 3 ? "d-flex" : "d-none" ?> align-items-center gap-1 strength-indicator js-strength-indicator" data-phase="3">
        <div><i class="fa-fw fas fa-paw"></i></div>
        <div class="progress me-1">
            <div class="progress-bar bg-warning" style="width:<?=$opponentPokemon->ivs->physicalAttack * 100?>%"></div>
        </div>
        <div><i class="fa-fw fas fa-wifi"></i></div>
        <div class="progress me-1">
            <div class="progress-bar bg-warning" style="width:<?=$opponentPokemon->ivs->specialAttack * 100?>%"></div>
        </div>
        <div><i class="fa-fw fas fa-shield-alt"></i></div>
        <div class="progress me-1">
            <div class="progress-bar bg-warning" style="width:<?=$opponentPokemon->ivs->physicalDefence * 100?>%"></div>
        </div>
        <div><i class="fa-fw fas fa-expand"></i></div>
        <div class="progress me-1">
            <div class="progress-bar bg-warning" style="width:<?=$opponentPokemon->ivs->specialDefence * 100?>%"></div>
        </div>
        <div><i class="fa-fw fas fa-wind"></i></div>
        <div class="progress me-1">
            <div class="progress-bar bg-warning" style="width:<?=$opponentPokemon->ivs->speed * 100?>%"></div>
        </div>
        <div><i class="fa-fw fas fa-heartbeat"></i></div>
        <div class="progress">
            <div class="progress-bar bg-warning" style="width:<?=$opponentPokemon->ivs->hp * 100?>%"></div>
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

<div class="battle-panel d-grid gap-2 js-interaction-container" style="text-align: center; border-bottom-width: 0;">
    <form method="POST" action="/<?=$instanceId?>/encounter/<?=$id?>/run" class="d-grid <?=$isBattleOver ? "" : "d-none"?>">
        <button type="submit" class="btn btn-outline-dark js-interaction">
            Finish
        </button>
    </form>
    <?php $mode = "encounter" ?>
    <?php require __DIR__ . "/ButtonsAttack.php" ?>
    <div class="d-flex w-100 gap-2">
        <?php foreach ($pokeballs as $pokeball) : ?>
            <form method="POST" action="/<?=$instanceId?>/encounter/<?=$id?>/catch" class="d-grid flex-grow-1 js-catch <?=$isBattleOver ? "d-none" : ""?>">
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
    <div class="d-grid flex-row" style="grid-template-columns: 1fr 1fr; column-gap: 0.5rem;">
        <a href="/<?=$instanceId?>/party/switch?redirect=<?=urlencode("/{$instanceId}/encounter/{$id}")?>" class="d-grid flew-grow-1 btn btn-outline-dark js-interaction <?=$isBattleOver ? "d-none" : ""?>">
            Switch
        </a>
        <form method="POST" action="/<?=$instanceId?>/encounter/<?=$id?>/run" class="d-grid flew-grow-1 <?=$isBattleOver ? "d-none" : ""?>">
            <button type="submit" class="btn btn-outline-secondary js-interaction">Run</button>
        </form>
    </div>
</div>

</div>

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
