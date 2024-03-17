<?php include __DIR__ . "/BottomNav.php" ?>

<div class="d-grid gap-4">

    <div class="d-flex gap-2 align-items-end">
        <h2 class="mb-0"><?=$currentLocation->name?></h2>
        <div>
            <?=$currentLocation->section?>
        </div>
    </div>

    <?php if ($canReviveFossils) : ?>

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div><strong>Fossils</strong></div>
                <div class="d-flex" style="text-align: center; gap: 4px;">
                    <img src="/assets/items/Bag_Dome_Fossil_Sprite.png">
                    <span><?=count($fossils)?></span>
                </div>
            </div>
            <ul class="list-group list-group-flush">
            <?php if (count($fossils) === 0) : ?>
                <li class="list-group-item d-flex align-items-center justify-content-center" style="height: 5rem;">
                    <h5><span style="color: #aaa;">No Fossils</span></h5>
                </li>
            <?php else : ?>
                <?php foreach ($fossils as $fossil) : ?>
                    <li class="list-group-item d-flex align-items-start">
                        <div class="d-flex align-items-center justify-content-center" style="width: 6rem; height: 6rem; margin-right: 1rem;">
                            <img src="<?=$fossil->imageUrl?>">
                        </div>
                        <div>
                            <div>
                                <strong>
                                    <?=$fossil->name?>
                                </strong>
                            </div>
                            <div>&times;<?=$fossil->quantity?></div>
                            <div class="d-flex align-items-center" style="margin-top: 0.4rem;">
                                <form method="POST" action="/<?=$instanceId?>/revive-fossil" style="margin-right: 0.6rem;">
                                    <input type="hidden" name="itemId" value="<?=$fossil->itemId?>">
                                    <button type="submit" class="btn btn-outline-dark btn-sm">Revive</button>
                                </form>
                            </div>
                        </div>
                    </li>
                <?php endforeach ?>
            <?php endif ?>
            </ul>
        </div>

    <?php endif ?>

</div>
