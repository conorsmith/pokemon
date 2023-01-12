<div class="d-grid gap-4">

    <h1 style="text-align: center;">Team</h1>

    <div class="card" style="text-align: center;">
        <div class="card-body">
            <strong><?=$unusedLevelUps?></strong> unused level ups
        </div>
    </div>

    <ul class="list-group">
        <?php foreach ($team as $pokemon) : ?>
            <li class="list-group-item d-flex">
                <img src="<?=$pokemon->imageUrl?>" style="width: 6rem; margin-right: 1rem;">
                <div>
                    <h5><?=$pokemon->name?></h5>
                    <p class="mb-0">Level <?=$pokemon->level?></p>
                    <?php if ($unusedLevelUps > 0) : ?>
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
