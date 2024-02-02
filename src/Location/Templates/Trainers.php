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
            <div><strong>Trainers</strong></div>
            <div class="d-flex" style="text-align: center; gap: 4px;">
                <img src="/assets/items/Bag_Contest_Pass_Sprite.png">
                <span><?=$challengeTokens?></span>
            </div>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($trainers as $trainer) : ?>
                <li class="list-group-item d-flex align-items-start">
                    <div class="me-2" style="width: 80px;">
                        <?php if (!is_null($trainer->imageUrl)) : ?>
                            <img src="<?=$trainer->imageUrl?>">
                        <?php endif ?>
                    </div>
                    <div>
                        <div><strong>
                                <?=$trainer->name?>
                                <?php if ($trainer->isGymLeader) : ?>
                                    <i class="fas fa-fw fa-medal"></i>
                                <?php endif ?>
                            </strong></div>
                        <div>
                            <small><?=$trainer->party?> Pokémon</small>
                            <?php if ($trainer->isGymLeader) : ?>
                                <small>&middot; <?=$trainer->leaderBadge?></small>
                            <?php endif ?>
                        </div>
                        <div class="d-flex align-items-center" style="margin-top: 0.4rem;">
                            <form method="POST" action="/<?=$instanceId?>/battle/trainer/<?=$trainer->id?>" style="margin-right: 0.6rem;">
                                <button type="submit" class="btn btn-outline-dark btn-sm" <?=$trainer->canBattle ? "" : "disabled"?>>Battle</button>
                            </form>
                            <?php if ($trainer->lastBeaten) : ?>
                                <span style="font-size: 0.8rem;">Last beaten <?=$trainer->lastBeaten?></span>
                            <?php endif ?>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </div>

</div>
