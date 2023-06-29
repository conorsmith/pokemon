<form method="POST" action="/<?=$instanceId?>/<?=$mode?>/<?=$id?>/fight" class=" d-grid gap-2 js-attack">
    <div class="d-grid flex-row <?=$isBattleOver ? "d-none" : ""?>" style="grid-template-columns: 1fr 1fr; column-gap: 0.5rem;">
        <button type="submit" class="btn btn-light btn-<?=$playerPokemon->primaryType?> js-interaction" name="attack" value="physical-primary">
            <i class="fas fa-fw fa-paw"></i> <span class="badge"><?=$playerPokemon->physicalAttack?></span>
        </button>
        <button type="submit" class="btn btn-light btn-<?=$playerPokemon->primaryType?> js-interaction" name="attack" value="special-primary">
            <i class="fas fa-fw fa-wifi"></i> <span class="badge"><?=$playerPokemon->specialAttack?></span>
        </button>
    </div>
    <div class="d-grid flex-row <?=$isBattleOver || !$playerPokemon->secondaryType ? "d-none" : ""?>" style="grid-template-columns: 1fr 1fr; column-gap: 0.5rem;">
        <button type="submit" class="btn btn-light btn-<?=$playerPokemon->secondaryType?> js-interaction" name="attack" value="physical-secondary">
            <i class="fas fa-fw fa-paw"></i> <span class="badge"><?=$playerPokemon->physicalAttack?></span>
        </button>
        <button type="submit" class="btn btn-light btn-<?=$playerPokemon->secondaryType?> js-interaction" name="attack" value="special-secondary">
            <i class="fas fa-fw fa-wifi"></i> <span class="badge"><?=$playerPokemon->specialAttack?></span>
        </button>
    </div>
</form>
