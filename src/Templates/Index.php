<?php foreach ($successes as $success) : ?>
    <div class="alert alert-success"><?=$success?></div>
<?php endforeach ?>

<?php if (isset($encounter)) : ?>

    <ul class="list-group" style="margin-top: 2rem; margin-bottom: 2rem;">
        <li class="list-group-item" style="text-align: center;">
            <strong>You encountered a wild</strong>
        </li>
        <li class="list-group-item d-flex">
            <img src="<?=$encounter->pokemon->imageUrl?>" style="width: 6rem; margin-right: 1rem;">
            <div>
                <h5><?=$encounter->pokemon->name?></h5>
                <p class="mb-0">Level <?=$encounter->pokemon->level?></p>
            </div>
        </li>
        <li class="list-group-item" style="text-align: center;">
            <p class="mb-0">
                <?php if ($encounter->caught) : ?>
                    <strong>You caught the wild <?=$encounter->pokemon->name?></strong>
                <?php else : ?>
                    <strong>You failed to catch the wild <?=$encounter->pokemon->name?></strong>
                <?php endif ?>
            </p>
            <?php if ($encounter->sentToBox) : ?>
                <p class="mb-0"><?=$encounter->pokemon->name?> was sent to your box</p>
            <?php endif ?>
        </li>
    </ul>
<?php endif ?>

<h2 style="text-align: center;">Team</h2>

<ul class="list-group" style="margin-top: 2rem;">
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
