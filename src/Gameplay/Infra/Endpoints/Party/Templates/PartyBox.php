<?php include __DIR__ . "/BottomNav.php" ?>

<div class="d-grid gap-4">

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><strong>Box</strong></div>
            <div><?=$box->filled?></div>
        </div>
        <ul class="list-group list-group-flush">
            <?php if ($box->filled === 0) : ?>
                <li class="list-group-item d-flex align-items-center justify-content-center" style="height: 5rem;">
                    <h5><span style="color: #aaa;">No Pokémon</span></h5>
                </li>
            <?php endif ?>
            <?php foreach ($box->slots as $slot) : ?>
                <?php $pokemon = $slot->pokemon ?>
                <?php require __DIR__ . "/ListPokemon.php" ?>
            <?php endforeach ?>
        </ul>
    </div>

</div>
