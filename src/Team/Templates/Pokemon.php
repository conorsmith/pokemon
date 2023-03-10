<div class="card">
    <div class="card-body" style="border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color);">
        <?php require __DIR__ . "/ListPokemon.php" ?>
    </div>
    <div class="card-body" style="border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color);">
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
                <td style="text-align: right;"><?=$stats->physicalAttack->iv?></td>
                <td style="text-align: right;"><?=$stats->physicalAttack->ev?></td>
                <td style="text-align: right;"><strong><?=$stats->physicalAttack->total?></strong></td>
            </tr>
            <tr>
                <td>Special Attack</td>
                <td style="text-align: right;"><?=$stats->specialAttack->base?></td>
                <td style="text-align: right;"><?=$stats->specialAttack->iv?></td>
                <td style="text-align: right;"><?=$stats->specialAttack->ev?></td>
                <td style="text-align: right;"><strong><?=$stats->specialAttack->total?></strong></td>
            </tr>
            <tr>
                <td>Physical Defence</td>
                <td style="text-align: right;"><?=$stats->physicalDefence->base?></td>
                <td style="text-align: right;"><?=$stats->physicalDefence->iv?></td>
                <td style="text-align: right;"><?=$stats->physicalDefence->ev?></td>
                <td style="text-align: right;"><strong><?=$stats->physicalDefence->total?></strong></td>
            </tr>
            <tr>
                <td>Special Defence</td>
                <td style="text-align: right;"><?=$stats->specialDefence->base?></td>
                <td style="text-align: right;"><?=$stats->specialDefence->iv?></td>
                <td style="text-align: right;"><?=$stats->specialDefence->ev?></td>
                <td style="text-align: right;"><strong><?=$stats->specialDefence->total?></strong></td>
            </tr>
            <tr>
                <td>Speed</td>
                <td style="text-align: right;"><?=$stats->speed->base?></td>
                <td style="text-align: right;"><?=$stats->speed->iv?></td>
                <td style="text-align: right;"><?=$stats->speed->ev?></td>
                <td style="text-align: right;"><strong><?=$stats->speed->total?></strong></td>
            </tr>
            <tr>
                <td>HP</td>
                <td style="text-align: right;"><?=$stats->hp->base?></td>
                <td style="text-align: right;"><?=$stats->hp->iv?></td>
                <td style="text-align: right;"><?=$stats->hp->ev?></td>
                <td style="text-align: right;"><strong><?=$stats->hp->total?></strong></td>
            </tr>
        </table>
    </div>
    <div class="card-body">
        <div style="margin-bottom: 1.4rem;">
            <div style="border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color); padding-bottom: 0.4rem; margin-bottom: 0.6rem;">
                <strong>Attacking</strong>
                <?php if ($pokemon->secondaryType) : ?>
                    <span class="badge bg-<?=$pokemon->primaryType?>" style="text-transform: uppercase;">
                        <?=$pokemon->primaryType?>
                    </span>
                <?php endif ?>
            </div>
            <div style="text-align: center;">
                <?php foreach ($typeEffectiveness->primaryAttacking->increase as $type => $multiplier) : ?>
                    <span class="badge bg-<?=$type?>" style="text-transform: uppercase;">
                        <?=$type?><span class="badge-addendum">&times;<?=$multiplier?></span>
                    </span>
                <?php endforeach ?>
            </div>
            <div style="text-align: center;">
                <?php foreach ($typeEffectiveness->primaryAttacking->decrease as $type => $multiplier) : ?>
                    <span class="badge bg-<?=$type?>" style="text-transform: uppercase;">
                        <?=$type?><span class="badge-addendum">&times;<?=$multiplier?></span>
                    </span>
                <?php endforeach ?>
            </div>
        </div>
        <?php if ($pokemon->secondaryType) : ?>
            <div style="margin-bottom: 1.4rem;">
                <div style="border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color); padding-bottom: 0.4rem; margin-bottom: 0.6rem;">
                    <strong>Attacking</strong>
                    <span class="badge bg-<?=$pokemon->secondaryType?>" style="text-transform: uppercase;">
                            <?=$pokemon->secondaryType?>
                        </span>
                </div>
                <div style="text-align: center;">
                    <?php foreach ($typeEffectiveness->secondaryAttacking->increase as $type => $multiplier) : ?>
                        <span class="badge bg-<?=$type?>" style="text-transform: uppercase;">
                            <?=$type?><span class="badge-addendum">&times;<?=$multiplier?></span>
                        </span>
                    <?php endforeach ?>
                </div>
                <div style="text-align: center;">
                    <?php foreach ($typeEffectiveness->secondaryAttacking->decrease as $type => $multiplier) : ?>
                        <span class="badge bg-<?=$type?>" style="text-transform: uppercase;">
                            <?=$type?><span class="badge-addendum">&times;<?=$multiplier?></span>
                        </span>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endif ?>
        <div>
            <div style="border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color); padding-bottom: 0.4rem; margin-bottom: 0.6rem;">
                <strong>Defending</strong>
            </div>
            <div style="text-align: center;">
                <?php foreach ($typeEffectiveness->defending->decrease as $type => $multiplier) : ?>
                    <span class="badge bg-<?=$type?>" style="text-transform: uppercase;">
                        <?=$type?><span class="badge-addendum">&times;<?=$multiplier?></span>
                    </span>
                <?php endforeach ?>
            </div>
            <div style="text-align: center;">
                <?php foreach ($typeEffectiveness->defending->increase as $type => $multiplier) : ?>
                    <span class="badge bg-<?=$type?>" style="text-transform: uppercase;">
                        <?=$type?><span class="badge-addendum">&times;<?=$multiplier?></span>
                    </span>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
