<?php foreach ($successes as $success) : ?>
    <div class="alert alert-success"><?=$success?></div>
<?php endforeach ?>

<table class="table-borderless w-100">
    <tr>
        <td>Money</td>
        <td style="text-align: right;">$<?=$summary->money?></td>
    </tr>
    <tr>
        <td>Poké Balls</td>
        <td style="text-align: right;"><?=$summary->pokeballs?></td>
    </tr>
    <tr>
        <td>Rare Candies</td>
        <td style="text-align: right;"><?=$summary->rareCandies?></td>
    </tr>
    <tr>
        <td>Challenge Tokens</td>
        <td style="text-align: right;"><?=$summary->challengeTokens?></td>
    </tr>
</table>

<ul class="list-group" style="margin-top: 2rem;">
    <?php foreach ($team as $pokemon) : ?>
        <li class="list-group-item d-flex">
            <img src="<?=$pokemon->imageUrl?>" style="width: 6rem; margin-right: 1rem;">
            <div>
                <h5><?=$pokemon->name?></h5>
                <p class="mb-0">
                    <span>
                        <span class="badge bg-<?=$pokemon->primaryType?>" style="text-transform: uppercase;">
                            <?=$pokemon->primaryType?>
                        </span>
                        <?php if ($pokemon->secondaryType) : ?>
                            <span class="badge bg-<?=$pokemon->secondaryType?>" style="text-transform: uppercase;">
                                <?=$pokemon->secondaryType?>
                            </span>
                        <?php endif ?>
                    </span>
                        <span style="margin: 0 0.4rem;">
                        Level <?=$pokemon->level?>
                    </span>
                </p>
            </div>
        </li>
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
