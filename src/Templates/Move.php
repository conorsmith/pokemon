<div class="d-grid gap-4" style="text-align: center;">

    <h1>Map</h1>

    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger"><?=$error?></div>
    <?php endforeach ?>

    <div class="card" style="text-align: center;">
        <div class="card-header">
            <h3 class="mb-0"><?=$currentLocation->name?></h3>
        </div>
    </div>

    <div class="d-grid gap-2">

        <?php foreach ($currentLocation->directions as $location) : ?>

            <form method="POST" class="d-grid">
                <input type="hidden" name="location" value="<?=$location->id?>">
                <button type="submit" class="btn btn-primary btn-lg" <?=$unusedMoves === 0 ? "disabled" : ""?>>Move to <?=$location->name?></button>
            </form>

        <?php endforeach ?>

    </div>

</div>
