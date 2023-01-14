<div class="d-grid gap-4">

    <h1 style="text-align: center;">Map</h1>

    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger"><?=$error?></div>
    <?php endforeach ?>

    <?php foreach ($successes as $success) : ?>
        <div class="alert alert-success"><?=$success?></div>
    <?php endforeach ?>

    <div class="card" style="text-align: center;">
        <div class="card-header">
            <h3 class="mb-0"><?=$currentLocation->name?></h3>
        </div>
        <div class="card-body">
            <strong><?=$pokeballs?></strong> Poké Balls
        </div>
    </div>

    <div class="d-grid gap-2">

        <form method="POST" class="d-grid">
            <input type="hidden" name="location" value="<?=$currentLocation->id?>">
            <button type="submit" class="btn btn-primary btn-lg" <?=$unusedEncounters === 0 ? "disabled" : ""?>>Search for Wild Pokémon</button>
        </form>

    </div>

    <div class="card">
        <div class="card-header" style="text-align: center;">
            <h3 class="mb-0">Trainers</h3>
        </div>
        <div class="card-body" style="text-align: center;">
            <strong><?=$battleTokens?></strong> Battle Tokens
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($trainers as $trainer) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div>
                        <div><strong><?=$trainer->name?></strong></div>
                        <div><small><?=$trainer->team?> Pokémon</small></div>
                        <form method="POST" action="/battle/trainer/<?=$trainer->id?>" style="margin-top: 0.4rem;">
                            <button type="submit" class="btn btn-outline-dark btn-sm" <?=$trainer->canBattle ? "" : "disabled"?>>Battle</button>
                        </form>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </div>

</div>
