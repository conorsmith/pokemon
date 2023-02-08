<?php foreach ($successes as $success) : ?>
    <div class="alert alert-success"><?=$success?></div>
<?php endforeach ?>

<style>
    .bagSummary img {
        width: 24px;
        filter: grayscale(1);
    }
</style>

<div class="card bagSummary">
    <div class="card-body d-flex justify-content-evenly">
        <div class="d-flex flex-column align-items-center">
            <img src="https://archives.bulbagarden.net/media/upload/9/93/Bag_Pok%C3%A9_Ball_Sprite.png">
            <?=$bagSummary->pokeBalls?>
        </div>
        <div class="d-flex flex-column align-items-center">
            <img src="https://archives.bulbagarden.net/media/upload/8/8d/Bag_Rare_Candy_Sprite.png">
            <?=$bagSummary->rareCandy?>
        </div>
        <div class="d-flex flex-column align-items-center">
            <img src="https://archives.bulbagarden.net/media/upload/c/c4/Bag_Contest_Pass_Sprite.png">
            <?=$bagSummary->challengeTokens?>
        </div>
        <div class="d-flex flex-column align-items-center">
            <img src="https://archives.bulbagarden.net/media/upload/8/86/Bag_Fire_Stone_Sprite.png">
            <?=$bagSummary->other?>
        </div>
    </div>
</div>

<ul class="list-group" style="margin-top: 2rem;">
    <?php foreach ($team as $pokemon) : ?>
        <?php require __DIR__ . "/../Team/Templates/Pokemon.php" ?>
    <?php endforeach ?>
</ul>

<h2 style="margin-top: 2rem; text-align: center;">Gym Badges</h2>

<div style="margin-top: 1rem; display: grid; grid-template-columns: repeat(4, 1fr); grid-auto-rows: 1fr; align-items: stretch; grid-column-gap: 0.4rem; grid-row-gap: 0.4rem;">
    <?php foreach ($badges as $badge) : ?>
        <div style="text-align: center; background: #f6f6f6; border-radius: 0.4rem; padding: 0.6rem;">
            <div><img src="<?=$badge->imageUrl?>" style="width: 50px;"></div>
            <div style="line-height: 100%; font-weight: bold; margin-top: 0.4rem;"><small><?=$badge->name?></small></div>
        </div>
    <?php endforeach ?>
    <?php for ($i = count($badges); $i < 8; $i++) : ?>
        <div class="d-flex align-items-center justify-content-center" style="text-align: center; min-height: 90px; background: #f6f6f6; border-radius: 0.4rem; color: #ccc;">
            <i class="far fa-fw fa-circle"></i>
        </div>
    <?php endfor ?>
</div>
