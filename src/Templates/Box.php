<div class="d-grid gap-4" style="text-align: center;">

    <h1>Box</h1>

    <ul class="list-group">
        <?php foreach ($team as $pokemon) : ?>
            <li class="list-group-item d-flex">
                <img src="<?=$pokemon->imageUrl?>" style="width: 6rem; margin-right: 1rem;">
                <div>
                    <h5><?=$pokemon->name?></h5>
                    <p class="mb-0">Level <?=$pokemon->level?></p>
                </div>
            </li>
        <?php endforeach ?>
    </ul>

</div>
