<?php include __DIR__ . "/BottomNav.php" ?>

<div class="d-grid gap-4">

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><strong>Party</strong></div>
            <div><?=$party->filled?> / <?=$party->maximum?></div>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($party->slots as $slot) : ?>
                <?php $pokemon = $slot->pokemon ?>
                <?php require __DIR__ . "/ListPokemon.php" ?>
                <li class="list-group-item d-flex justify-content-between w-100" style="background: #fafafa;">
                    <div class="d-flex">
                        <form method="POST" action="/<?=$instanceId?>/party/move-up" style="margin-right: 0.4rem;">
                            <input type="hidden" name="pokemon" value="<?=$slot->pokemon->id?>">
                            <button type="submit" class="btn btn-outline-dark btn-sm" <?=$slot->canMoveUp ? "" : "disabled"?>>
                                <i class="fas fa-fw fa-chevron-up"></i>
                            </button>
                        </form>
                        <form method="POST" action="/<?=$instanceId?>/party/move-down">
                            <input type="hidden" name="pokemon" value="<?=$slot->pokemon->id?>">
                            <button type="submit" class="btn btn-outline-dark btn-sm" <?=$slot->canMoveDown ? "" : "disabled"?>>
                                <i class="fas fa-fw fa-chevron-down"></i>
                            </button>
                        </form>
                    </div>
                </li>
            <?php endforeach ?>
            <?php for ($i = $party->filled; $i < $party->maximum; $i++) : ?>
                <li class="list-group-item d-flex">
                    <div style="width: 6rem; height: 5rem;"></div>
                </li>
            <?php endfor ?>
        </ul>
    </div>

    <?php if ($party->filled > 0) : ?>
        <div class="card">
            <div class="card-body" style="border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color);">
                <div class="d-flex justify-content-between">
                    <strong>Type Coverage</strong>
                    <div style="text-align: right;">
                        <?php if ($coverage->counts->increase) : ?>
                            <span class="badge text-bg-primary" style="text-transform: uppercase;">
                                <?=$coverage->counts->increase?><span class="badge-addendum">&times;2</span>
                            </span>
                        <?php endif ?>
                        <?php if ($coverage->counts->unmodified) : ?>
                            <span class="badge text-bg-secondary" style="text-transform: uppercase;">
                                <?=$coverage->counts->unmodified?><span class="badge-addendum">&times;1</span>
                            </span>
                        <?php endif ?>
                        <?php if ($coverage->counts->decrease) : ?>
                            <span class="badge text-bg-danger" style="text-transform: uppercase;">
                                <?=$coverage->counts->decrease?><span class="badge-addendum">&times;½</span>
                            </span>
                        <?php endif ?>
                        <?php if ($coverage->counts->zero) : ?>
                            <span class="badge text-bg-danger" style="text-transform: uppercase;">
                                <?=$coverage->counts->zero?><span class="badge-addendum">&times;0</span>
                            </span>
                        <?php endif ?>
                    </div>
                </div>
                <?php if ($coverage->increase) : ?>
                    <div style="border-top: var(--bs-card-border-width) solid var(--bs-card-border-color); padding-top: 0.4rem; margin-top: 0.6rem; text-align: center;">
                        <?php foreach ($coverage->increase as $type => $multiplier) : ?>
                            <span class="badge bg-<?=$type?>" style="text-transform: uppercase;">
                                <?=$type?><span class="badge-addendum">&times;<?=$multiplier?></span>
                            </span>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
                <?php if ($coverage->unmodified) : ?>
                    <div style="border-top: var(--bs-card-border-width) solid var(--bs-card-border-color); padding-top: 0.4rem; margin-top: 0.6rem; text-align: center;">
                        <?php foreach ($coverage->unmodified as $type => $multiplier) : ?>
                            <span class="badge bg-<?=$type?>" style="text-transform: uppercase;">
                                <?=$type?><span class="badge-addendum">&times;<?=$multiplier?></span>
                            </span>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
                <?php if ($coverage->decrease) : ?>
                    <div style="border-top: var(--bs-card-border-width) solid var(--bs-card-border-color); padding-top: 0.4rem; margin-top: 0.6rem; text-align: center;">
                        <?php foreach ($coverage->decrease as $type => $multiplier) : ?>
                            <span class="badge bg-<?=$type?>" style="text-transform: uppercase;">
                                <?=$type?><span class="badge-addendum">&times;<?=$multiplier?></span>
                            </span>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
                <?php if ($coverage->zero) : ?>
                    <div style="border-top: var(--bs-card-border-width) solid var(--bs-card-border-color); padding-top: 0.4rem; margin-top: 0.6rem; text-align: center;">
                        <?php foreach ($coverage->zero as $type => $multiplier) : ?>
                            <span class="badge bg-<?=$type?>" style="text-transform: uppercase;">
                                <?=$type?><span class="badge-addendum">&times;<?=$multiplier?></span>
                            </span>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="card-body d-grid gap-2">
                <a href="/<?=$instanceId?>/party/compare" class="btn btn-outline-dark">Compare Stats</a>
                <a href="/<?=$instanceId?>/party/combinations" class="btn btn-outline-dark">Strongest Pokémon</a>
            </div>
        </div>
    <?php endif ?>

</div>
