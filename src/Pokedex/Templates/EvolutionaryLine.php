<?php foreach ($evolutions as $evolution) : ?>
    <?php if ($evolution->type === "pokemon") : ?>
        <?php $pokemon = $evolution->pokemon ?>
        <?php if ($evolution->isRegistered) : ?>
            <li class="list-group-item d-flex">
                <?php include __DIR__ . "/PokemonListItem.php" ?>
            </li>
        <?php else : ?>
            <li class="list-group-item d-flex">
                <div class="d-flex align-items-center justify-content-center" style="width: 6rem; height: 5rem; margin-right: 1rem; color: #aaa;">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div>
                    <h5><span style="color: #aaa;">#<?=$pokemon->pokedexNumber?></span></h5>
                    <p class="mb-0">
                                <span class="badge" style="text-transform: uppercase; background-color: #aaa; color: #fff;">
                                    ???
                                </span>
                    </p>
                </div>
            </li>
        <?php endif ?>
    <?php elseif ($evolution->type === "evolution") : ?>
        <li class="list-group-item evolution-trigger d-flex justify-content-between align-items-center">
            <i class="fas fa-arrow-down"></i>
            <span>
                <?php if ($evolution->trigger->type === "level") : ?>
                    Level up at <strong>Lv <?=$evolution->trigger->level?></strong>
                <?php elseif ($evolution->trigger->type === "item") : ?>
                    Use <strong><?=$evolution->trigger->item?></strong>
                <?php elseif ($evolution->trigger->type === "friendship") : ?>
                    Level up with <strong>high&nbsp;friendship</strong>
                <?php elseif ($evolution->trigger->type === "friendship-time") : ?>
                    Level up with <strong>high&nbsp;friendship</strong> <?=$evolution->trigger->time?>
                <?php elseif ($evolution->trigger->type === "friendship-move") : ?>
                    Level up with <strong>high&nbsp;friendship</strong> while holding type‑boosting&nbsp;item
                <?php elseif ($evolution->trigger->type === "move") : ?>
                    Level up while holding type‑boosting&nbsp;item
                <?php elseif ($evolution->trigger->type === "holding-time") : ?>
                    Level up while holding <strong><?=$evolution->trigger->item?></strong> <?=$evolution->trigger->time?>
                <?php elseif ($evolution->trigger->type === "item-time") : ?>
                    Use <strong><?=$evolution->trigger->item?></strong> <?=$evolution->trigger->time?>
                <?php elseif ($evolution->trigger->type === "item-sex") : ?>
                    Use <strong><?=$evolution->trigger->item?></strong> if <?=$evolution->trigger->sex?>
                <?php elseif ($evolution->trigger->type === "level-stats") : ?>
                    Level up at <strong>Lv <?=$evolution->trigger->level?></strong> with
                    <br>
                    <i class="fas fa-fw fa-paw"></i>
                    <i class="fas fa-fw fa-<?=$evolution->trigger->stats?>"></i>
                    <i class="fas fa-fw fa-wifi"></i>
                <?php elseif ($evolution->trigger->type === "level-randomly") : ?>
                    50% chance when<br>levelled up at <strong>Lv <?=$evolution->trigger->level?></strong>
                <?php endif ?>
            </span>
            <i class="fas fa-arrow-down"></i>
        </li>
    <?php elseif ($evolution->type === "branch") : ?>
        <div class="card evolution-branch">
            <ul class="list-group list-group-flush">
                <?php $evolutions = $evolution->vms ?>
                <?php include __DIR__ . "/EvolutionaryLine.php" ?>
            </ul>
        </div>
    <?php endif ?>
<?php endforeach ?>

