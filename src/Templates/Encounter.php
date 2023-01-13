<ul class="list-group" style="margin-top: 2rem; margin-bottom: 2rem;">
    <li class="list-group-item" style="text-align: center;">
        <strong>You encountered a wild <?=$pokemon->name?></strong>
    </li>
    <li class="list-group-item d-flex flex-row-reverse">
        <img src="<?=$pokemon->imageUrl?>" style="width: 6rem; margin-left: 1rem;">
        <div style="text-align: right;">
            <h5><?=$pokemon->name?></h5>
            <p class="mb-0">Level <?=$pokemon->level?></p>
        </div>
    </li>
    <li class="list-group-item d-flex">
        <img src="<?=$leadPokemon->imageUrl?>" style="width: 6rem; margin-right: 1rem;">
        <div>
            <h5><?=$leadPokemon->name?></h5>
            <p class="mb-0">Level <?=$leadPokemon->level?></p>
        </div>
    </li>
    <li class="list-group-item d-grid gap-2" style="text-align: center;">
        <form method="POST" action="/encounter/<?=$id?>/catch" class="d-grid">
            <button type="submit" class="btn btn-primary">
                Throw Poké Ball
                <span class="badge text-bg-light"><?=$pokeballs?></span>
            </button>
        </form>
        <form method="POST" action="/encounter/<?=$id?>/run" class="d-grid">
            <button type="submit" class="btn btn-outline-secondary">Run</button>
        </form>
    </li>
</ul>
