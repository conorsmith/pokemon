<div class="d-grid gap-4" style="text-align: center;">

    <h1>Map</h1>

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

</div>
