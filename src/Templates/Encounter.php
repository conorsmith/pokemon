<?php foreach ($errors as $error) : ?>
    <div class="alert alert-danger"><?=$error?></div>
<?php endforeach ?>

<?php foreach ($successes as $success) : ?>
    <div class="alert alert-success"><?=$success?></div>
<?php endforeach ?>

<ul class="list-group" style="margin-top: 2rem; margin-bottom: 2rem;">
    <li class="list-group-item" style="text-align: center;">
        <strong>You encountered a wild <?=$pokemon->name?></strong>
    </li>
    <li class="list-group-item d-flex flex-row-reverse">
        <div class="pokemon-image <?=$pokemon->isShiny ? "pokemon-image--shiny" : ""?> pokemon-image--encounter">
            <img src="<?=$pokemon->imageUrl?>">
        </div>
        <div style="text-align: right;">
            <h5>
                <?=$pokemon->name?>
            </h5>
            <p class="mb-0">
                <?php if ($pokemon->isRegistered) : ?>
                    <i class="fas fa-fw fa-circle" style="color: #888;"></i>
                <?php else : ?>
                    <i class="far fa-fw fa-circle" style="color: #888;"></i>
                <?php endif ?>
                Lv <?=$pokemon->level?>
            </p>
        </div>
    </li>
    <li class="list-group-item d-flex">
        <div class="pokemon-image <?=$leadPokemon->isShiny ? "pokemon-image--shiny" : ""?>">
            <img src="<?=$leadPokemon->imageUrl?>">
        </div>
        <div>
            <h5><?=$leadPokemon->name?></h5>
            <p class="mb-0">Lv <?=$leadPokemon->level?></p>
        </div>
    </li>
    <li class="list-group-item d-grid gap-2" style="text-align: center;">
        <?php foreach ($pokeballs as $pokeball) : ?>
            <form method="POST" action="/encounter/<?=$id?>/catch" class="d-grid">
                <button type="submit" name="pokeball" value="<?=$pokeball->id?>" class="btn btn-outline-primary d-flex justify-content-between">
                    <div class="me-2" style="width: 40px; text-align: center;">
                        <img src="<?=$pokeball->imageUrl?>">
                    </div>
                    Throw <?=$pokeball->name?>
                    <div style="width: 40px; text-align: center;">
                        <span class="badge text-bg-primary"><?=$pokeball->amount?></span>
                    </div>
                </button>
            </form>
        <?php endforeach ?>
        <form method="POST" action="/encounter/<?=$id?>/run" class="d-grid">
            <button type="submit" class="btn btn-outline-secondary">Run</button>
        </form>
    </li>
</ul>
