<form method="POST" action="/<?=$mode?>>/<?=$id?>/fight" class="d-grid flex-row js-attack <?=$isBattleOver ? "d-none" : ""?>" style="grid-template-columns: 1fr 1fr; column-gap: 0.5rem;">
    <button type="submit" class="btn btn-primary js-interaction" name="attack" value="physical">
        <i class="fas fa-fw fa-paw"></i> Physical <span class="badge"><?=$playerPokemon->physicalAttack?></span>
    </button>
    <button type="submit" class="btn btn-primary js-interaction" name="attack" value="special">
        <i class="fas fa-fw fa-wifi"></i> Special <span class="badge"><?=$playerPokemon->specialAttack?></span>
    </button>
</form>
