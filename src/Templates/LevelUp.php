<div class="d-grid gap-4">

    <h1 style="text-align: center;">Team</h1>

    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger"><?=$error?></div>
    <?php endforeach ?>

    <?php foreach ($successes as $success) : ?>
        <div class="alert alert-success"><?=$success?></div>
    <?php endforeach ?>

    <div class="card" style="text-align: center;">
        <div class="card-body">
            <strong><?=$rareCandies?></strong> rare candies
        </div>
    </div>

    <ul class="list-group">
        <?php foreach ($team as $pokemon) : ?>
            <li class="list-group-item d-flex">
                <img src="<?=$pokemon->imageUrl?>" style="width: 6rem; margin-right: 1rem;">
                <div>
                    <h5><?=$pokemon->name?></h5>
                    <p class="mb-0">Lv <?=$pokemon->level?></p>
                    <?php if ($rareCandies > 0) : ?>
                        <form method="POST" style="margin-top: 1rem;">
                            <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                            <button type="submit" class="btn btn-primary btn-sm">Level Up!</button>
                        </form>
                    <?php endif ?>
                </div>
            </li>
        <?php endforeach ?>
    </ul>

</div>
