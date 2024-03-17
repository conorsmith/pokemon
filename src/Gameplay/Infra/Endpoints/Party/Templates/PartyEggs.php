<?php include __DIR__ . "/BottomNav.php" ?>

<div class="d-grid gap-4">

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><strong>Eggs</strong></div>
            <div><?=$eggs->filled?></div>
        </div>
        <ul class="list-group list-group-flush">
            <?php if ($eggs->filled === 0) : ?>
                <li class="list-group-item d-flex align-items-center justify-content-center" style="height: 5rem;">
                    <h5><span style="color: #aaa;">No Eggs</span></h5>
                </li>
            <?php endif ?>
            <?php foreach ($eggs->slots as $slot) : ?>
                <li class="list-group-item d-flex align-items-center">
                    <div>
                        <img src="/assets/Spr_3r_Egg.png">
                    </div>
                    <div>
                        <?php if ($slot->hasParents) : ?>
                            <div>
                                <span style="font-weight: bold;"><?=$slot->firstParent->name?></span>
                                <?php if ($slot->firstParent->sex === \ConorSmith\Pokemon\SharedKernel\Domain\Sex::FEMALE) : ?>
                                    <i class="fas fa-venus"></i>
                                <?php elseif ($slot->firstParent->sex === \ConorSmith\Pokemon\SharedKernel\Domain\Sex::MALE) : ?>
                                    <i class="fas fa-mars"></i>
                                <?php elseif ($slot->firstParent->sex === \ConorSmith\Pokemon\SharedKernel\Domain\Sex::UNKNOWN) : ?>
                                    <i class="fas fa-genderless"></i>
                                <?php endif ?>
                                and
                                <span style="font-weight: bold;"><?=$slot->secondParent->name?></span>
                                <?php if ($slot->secondParent->sex === \ConorSmith\Pokemon\SharedKernel\Domain\Sex::FEMALE) : ?>
                                    <i class="fas fa-venus"></i>
                                <?php elseif ($slot->secondParent->sex === \ConorSmith\Pokemon\SharedKernel\Domain\Sex::MALE) : ?>
                                    <i class="fas fa-mars"></i>
                                <?php elseif ($slot->secondParent->sex === \ConorSmith\Pokemon\SharedKernel\Domain\Sex::UNKNOWN) : ?>
                                    <i class="fas fa-genderless"></i>
                                <?php endif ?>
                            </div>
                        <?php else: ?>
                            <div>
                                <span style="font-weight: bold;"><?=$slot->name?> Egg</span>
                            </div>
                        <?php endif ?>
                        <div style="font-size: 0.8rem;"><?=$slot->cycles?> cycles remaining</div>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </div>

</div>
