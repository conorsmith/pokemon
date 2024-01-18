<?php include __DIR__ . "/BottomNav.php" ?>

<div class="d-grid gap-4">

<div class="card">
    <div class="card-body">
        <?php require __DIR__ . "/ListPokemon.php" ?>
        <div class="mt-2">
            <div>Joined the party <?=$capture->preposition?></div>
            <div><strong><?=$capture->location?></strong> <span class="badge bg-secondary"><?=$capture->region?></span></div>
        </div>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-end" style="background: #fafafa;">
            <div class="d-flex gap-2">
                <div class="dropdown">
                    <a class="btn btn-outline-dark btn-sm" href="/<?=$instanceId?>/party/member/<?=$pokemon->id?>/item-use"">
                        Use Item
                    </a>
                    <a class="btn btn-outline-dark btn-sm dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Send
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php if (!$location->isInParty) : ?>
                            <li>
                                <form method="POST" action="/<?=$instanceId?>/party/send-to-party">
                                    <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                                    <button type="submit" class="dropdown-item" <?=$location->canSendToParty ? "" : "disabled"?>>
                                        Send to Party
                                    </button>
                                </form>
                            </li>
                        <?php endif ?>
                        <?php if (!$location->isInDayCare) : ?>
                            <li>
                                <form method="POST" action="/<?=$instanceId?>/party/send-to-day-care">
                                    <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                                    <button type="submit" class="dropdown-item" <?=$location->canSendToDayCare ? "" : "disabled"?>>
                                        Send to Day Care
                                    </button>
                                </form>
                            </li>
                        <?php endif ?>
                        <?php if (!$location->isInBox) : ?>
                            <li>
                                <form method="POST" action="/<?=$instanceId?>/party/send-to-box">
                                    <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                                    <button type="submit" class="dropdown-item" <?=$location->canSendToBox ? "" : "disabled"?>>
                                        Send to Box
                                    </button>
                                </form>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</div>

<div class="card">
    <div class="card-body" style="border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color);">
        <table class="table pokemon-stats">
            <tr>
                <td></td>
                <td style="text-align: right;"><i class="fas fa-code-branch"></i></td>
                <td style="text-align: right; padding-right: 1rem;"><i class="fas fa-dna"></i></td>
                <td style="text-align: right;"><i class="fas fa-running"></i></td>
                <td></td>
            </tr>
            <tr>
                <td><i class="fa-fw fas fa-paw"></i> Physical Attack</td>
                <td class="stat"><?=$stats->physicalAttack->base?></td>
                <td class="stat <?=$stats->physicalAttack->ivDeviation->class?>" style="text-align: right;"><?=$stats->physicalAttack->ivDeviation->value?></td>
                <td class="stat"><?=$stats->physicalAttack->ev?></td>
                <td class="stat"><strong><?=$stats->physicalAttack->total?></strong></td>
            </tr>
            <tr>
                <td><i class="fa-fw fas fa-wifi"></i> Special Attack</td>
                <td class="stat"><?=$stats->specialAttack->base?></td>
                <td class="stat <?=$stats->specialAttack->ivDeviation->class?>" style="text-align: right;"><?=$stats->specialAttack->ivDeviation->value?></td>
                <td class="stat"><?=$stats->specialAttack->ev?></td>
                <td class="stat"><strong><?=$stats->specialAttack->total?></strong></td>
            </tr>
            <tr>
                <td><i class="fa-fw fas fa-shield-alt"></i> Physical Defence</td>
                <td class="stat"><?=$stats->physicalDefence->base?></td>
                <td class="stat <?=$stats->physicalDefence->ivDeviation->class?>" style="text-align: right;"><?=$stats->physicalDefence->ivDeviation->value?></td>
                <td class="stat"><?=$stats->physicalDefence->ev?></td>
                <td class="stat"><strong><?=$stats->physicalDefence->total?></strong></td>
            </tr>
            <tr>
                <td><i class="fa-fw fas fa-expand"></i> Special Defence</td>
                <td class="stat"><?=$stats->specialDefence->base?></td>
                <td class="stat <?=$stats->specialDefence->ivDeviation->class?>" style="text-align: right;"><?=$stats->specialDefence->ivDeviation->value?></td>
                <td class="stat"><?=$stats->specialDefence->ev?></td>
                <td class="stat"><strong><?=$stats->specialDefence->total?></strong></td>
            </tr>
            <tr>
                <td><i class="fa-fw fas fa-wind"></i> Speed</td>
                <td class="stat"><?=$stats->speed->base?></td>
                <td class="stat <?=$stats->speed->ivDeviation->class?>" style="text-align: right;"><?=$stats->speed->ivDeviation->value?></td>
                <td class="stat"><?=$stats->speed->ev?></td>
                <td class="stat"><strong><?=$stats->speed->total?></strong></td>
            </tr>
            <tr>
                <td><i class="fa-fw fas fa-heartbeat"></i> HP</td>
                <td class="stat"><?=$stats->hp->base?></td>
                <td class="stat <?=$stats->hp->ivDeviation->class?>" style="text-align: right;"><?=$stats->hp->ivDeviation->value?></td>
                <td class="stat"><?=$stats->hp->ev?></td>
                <td class="stat"><strong><?=$stats->hp->total?></strong></td>
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

</div>
