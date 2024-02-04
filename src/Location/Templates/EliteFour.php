<?php include __DIR__ . "/BottomNav.php" ?>

<div class="d-grid gap-4">

    <div class="d-flex justify-content-between align-items-end">
        <h2 class="mb-0"><?=$currentLocation->name?></h2>
        <div>
            <span class="badge bg-secondary"><?=$currentLocation->region?></span>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><strong>Elite Four</strong></div>
            <div class="d-flex" style="text-align: center; gap: 4px;">
                <img src="/assets/items/Bag_Contest_Pass_Sprite.png">
                <span><?=$challengeTokens?></span>
            </div>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex flex-column">
                <div class="d-flex justify-content-center w-100">
                    <?php foreach ($eliteFour->memberImageUrls as $memberImageUrl) : ?>
                        <div class="me-2" style="width: 80px;">
                            <img src="<?=$memberImageUrl?>">
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="d-flex justify-content-center w-100 mt-3 mb-2">
                    <form method="POST" action="/<?=$instanceId?>/challenge/elite-four/<?=$eliteFour->region?>">
                        <button type="submit" class="btn btn-outline-dark btn-sm" <?=$eliteFour->canChallenge ? "" : "disabled"?>>
                            Challenge the Elite Four
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>

</div>
