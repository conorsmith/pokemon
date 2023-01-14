<h1 style="text-align: center;">Trainer Battle</h1>

<?php foreach ($errors as $error) : ?>
    <div class="alert alert-danger"><?=$error?></div>
<?php endforeach ?>

<?php foreach ($successes as $success) : ?>
    <div class="alert alert-success"><?=$success?></div>
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
        <img src="<?=$activePokemon->imageUrl?>" style="width: 6rem; margin-left: 1rem;">
        <div style="text-align: right;">
            <h5><?=$activePokemon->name?></h5>
            <p class="mb-0">Level <?=$activePokemon->level?></p>
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
        <form method="POST" action="/battle/<?=$id?>/fight" class="d-grid">
            <button type="submit" class="btn btn-primary">
                Fight
            </button>
        </form>
        <form method="POST" action="/battle/<?=$id?>/switch" class="d-grid">
            <button type="submit" class="btn btn-outline-dark">
                Switch
            </button>
        </form>
    </li>
</ul>
