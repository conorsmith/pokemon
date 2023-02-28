<div class="card">
    <div class="card-body" style="border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color);">
        <?php require __DIR__ . "/ListPokemon.php" ?>
    </div>
    <div class="card-body">
        <table class="table">
            <tr>
                <td></td>
                <td style="text-align: right;"><i class="fas fa-code-branch"></i></td>
                <td style="text-align: right;"><i class="fas fa-dna"></i></td>
                <td style="text-align: right;"><i class="fas fa-running"></i></td>
                <td></td>
            </tr>
            <tr>
                <td>Physical Attack</td>
                <td style="text-align: right;"><?=$stats->physicalAttack->base?></td>
                <td style="text-align: right;">+<?=$stats->physicalAttack->iv?></td>
                <td style="text-align: right;">+<?=$stats->physicalAttack->ev?></td>
                <td style="text-align: right;"><strong><?=$stats->physicalAttack->total?></strong></td>
            </tr>
            <tr>
                <td>Special Attack</td>
                <td style="text-align: right;"><?=$stats->specialAttack->base?></td>
                <td style="text-align: right;">+<?=$stats->specialAttack->iv?></td>
                <td style="text-align: right;">+<?=$stats->specialAttack->ev?></td>
                <td style="text-align: right;"><strong><?=$stats->specialAttack->total?></strong></td>
            </tr>
            <tr>
                <td>Physical Defence</td>
                <td style="text-align: right;"><?=$stats->physicalDefence->base?></td>
                <td style="text-align: right;">+<?=$stats->physicalDefence->iv?></td>
                <td style="text-align: right;">+<?=$stats->physicalDefence->ev?></td>
                <td style="text-align: right;"><strong><?=$stats->physicalDefence->total?></strong></td>
            </tr>
            <tr>
                <td>Special Defence</td>
                <td style="text-align: right;"><?=$stats->specialDefence->base?></td>
                <td style="text-align: right;">+<?=$stats->specialDefence->iv?></td>
                <td style="text-align: right;">+<?=$stats->specialDefence->ev?></td>
                <td style="text-align: right;"><strong><?=$stats->specialDefence->total?></strong></td>
            </tr>
            <tr>
                <td>Speed</td>
                <td style="text-align: right;"><?=$stats->speed->base?></td>
                <td style="text-align: right;">+<?=$stats->speed->iv?></td>
                <td style="text-align: right;">+<?=$stats->speed->ev?></td>
                <td style="text-align: right;"><strong><?=$stats->speed->total?></strong></td>
            </tr>
            <tr>
                <td>HP</td>
                <td style="text-align: right;"><?=$stats->hp->base?></td>
                <td style="text-align: right;">+<?=$stats->hp->iv?></td>
                <td style="text-align: right;">+<?=$stats->hp->ev?></td>
                <td style="text-align: right;"><strong><?=$stats->hp->total?></strong></td>
            </tr>
        </table>
    </div>
</div>
