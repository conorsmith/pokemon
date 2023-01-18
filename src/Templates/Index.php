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
