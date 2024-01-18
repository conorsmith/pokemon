<form method="POST"
      action="/<?=$instanceId?>/<?=$mode?>/<?=$id?>/fight"
      class=" d-grid gap-2 js-attack"
>
    <div class="d-grid flex-row <?=$isBattleOver ? "d-none" : ""?>"
         style="grid-template-columns: 1fr 1fr; column-gap: 0.5rem;"
    >
        <button type="submit"
                class="btn btn-light position-relative btn-<?=$playerPokemon->primaryType?> js-interaction"
                name="attack"
                value="physical-primary"
        >
            <i class="fas fa-fw fa-paw"></i>
            <span class="js-stats badge"><?=$playerPokemon->physicalAttack?></span>
        </button>
        <button type="submit"
                class="btn btn-light position-relative btn-<?=$playerPokemon->primaryType?> js-interaction"
                name="attack"
                value="special-primary"
        >
            <i class="fas fa-fw fa-wifi"></i>
            <span class="js-stats badge"><?=$playerPokemon->specialAttack?></span>
            <span class="js-effectiveness position-absolute top-50 start-100 translate-middle badge rounded-pill <?=$primaryTypeEffectiveness->contextClass?> <?=$primaryTypeEffectiveness->isDisplayed ? "" : "d-none"?>">
                &times;<?=$primaryTypeEffectiveness->value?>
            </span>
        </button>
    </div>
    <div class="d-grid flex-row <?=$isBattleOver || !$playerPokemon->secondaryType ? "d-none" : ""?>"
         style="grid-template-columns: 1fr 1fr; column-gap: 0.5rem;"
    >
        <button type="submit"
                class="btn btn-light position-relative btn-<?=$playerPokemon->secondaryType?> js-interaction"
                name="attack"
                value="physical-secondary"
        >
            <i class="fas fa-fw fa-paw"></i>
            <span class="js-stats badge"><?=$playerPokemon->physicalAttack?></span>
        </button>
        <button type="submit"
                class="btn btn-light position-relative btn-<?=$playerPokemon->secondaryType?> js-interaction"
                name="attack"
                value="special-secondary"
        >
            <i class="fas fa-fw fa-wifi"></i>
            <span class="js-stats badge"><?=$playerPokemon->specialAttack?></span>
            <span class="js-effectiveness position-absolute top-50 start-100 translate-middle badge rounded-pill <?=$secondaryTypeEffectiveness->contextClass?> <?=$secondaryTypeEffectiveness->isDisplayed ? "" : "d-none"?>">
                &times;<?=$secondaryTypeEffectiveness->value?>
            </span>
        </button>
    </div>
</form>
