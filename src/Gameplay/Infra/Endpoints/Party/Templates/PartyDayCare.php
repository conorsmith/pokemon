<?php include __DIR__ . "/BottomNav.php" ?>

<div class="d-grid gap-4">

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><strong>Day Care</strong></div>
            <div><?=$dayCare->filled?> / <?=$dayCare->maximum?></div>
        </div>
        <ul class="list-group list-group-flush">
            <?php if ($dayCare->maximum === 0) : ?>
                <li class="list-group-item d-flex align-items-center justify-content-center" style="height: 5rem;">
                    <h5><span style="color: #aaa;">No Day Care Slots</span></h5>
                </li>
            <?php endif ?>
            <?php foreach ($dayCare->slots as $slot) : ?>
                <?php $pokemon = $slot->pokemon ?>
                <?php require __DIR__ . "/ListPokemon.php" ?>
            <?php endforeach ?>
            <?php for ($i = $dayCare->filled; $i < $dayCare->maximum; $i++) : ?>
                <li class="list-group-item d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center" style="width: 6rem; height: 5rem; margin-right: 1rem; color: #aaa;">
                        <i class="fas fa-dot-circle"></i>
                    </div>
                    <div>
                        <h5><span style="color: #aaa;">Place Available</span></h5>
                    </div>
                </li>
            <?php endfor ?>
        </ul>
    </div>

</div>
