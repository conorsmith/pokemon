<?php include __DIR__ . "/BottomNav.php" ?>

<div class="d-grid gap-4">

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><strong>Box</strong></div>
            <div><?=$box->filled?></div>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($box->slots as $slot) : ?>
                <?php $pokemon = $slot->pokemon ?>
                <?php require __DIR__ . "/ListPokemon.php" ?>
            <?php endforeach ?>
        </ul>
    </div>

</div>
