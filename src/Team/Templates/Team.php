<div class="d-grid gap-4">

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><strong>Team</strong></div>
            <div><?=$team->filled?> / <?=$team->maximum?></div>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($team->slots as $slot) : ?>
                <?php $pokemon = $slot->pokemon ?>
                <?php require __DIR__ . "/ListPokemon.php" ?>
                <li class="list-group-item d-flex justify-content-between w-100" style="background: #fafafa;">
                    <div class="d-flex">
                        <form method="POST" action="/<?=$instanceId?>/team/move-up" style="margin-right: 0.4rem;">
                            <input type="hidden" name="pokemon" value="<?=$slot->pokemon->id?>">
                            <button type="submit" class="btn btn-outline-dark btn-sm" <?=$slot->canMoveUp ? "" : "disabled"?>>
                                <i class="fas fa-fw fa-chevron-up"></i>
                            </button>
                        </form>
                        <form method="POST" action="/<?=$instanceId?>/team/move-down">
                            <input type="hidden" name="pokemon" value="<?=$slot->pokemon->id?>">
                            <button type="submit" class="btn btn-outline-dark btn-sm" <?=$slot->canMoveDown ? "" : "disabled"?>>
                                <i class="fas fa-fw fa-chevron-down"></i>
                            </button>
                        </form>
                    </div>
                    <div class="d-flex gap-2">
                        <a class="btn btn-outline-dark btn-sm" href="/<?=$instanceId?>/team/member/<?=$slot->pokemon->id?>">
                            Stats
                        </a>
                        <div class="dropdown">
                            <a class="btn btn-outline-dark btn-sm dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                Send
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form method="POST" action="/<?=$instanceId?>/team/send-to-box">
                                        <input type="hidden" name="pokemon" value="<?=$slot->pokemon->id?>">
                                        <button type="submit" class="dropdown-item" <?=$slot->canSendToBox ? "" : "disabled"?>>
                                            Send to Box
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form method="POST" action="/<?=$instanceId?>/team/send-to-day-care">
                                        <input type="hidden" name="pokemon" value="<?=$slot->pokemon->id?>">
                                        <button type="submit" class="dropdown-item" <?=$slot->canSendToDayCare ? "" : "disabled"?>>
                                            Send to Day Care
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
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
            <a href="/<?=$instanceId?>/team/compare" class="btn btn-outline-dark">Compare Stats</a>
            <a href="/<?=$instanceId?>/team/combinations" class="btn btn-outline-dark">Strongest Pokémon</a>
        </div>
    </div>

    <?php if (!$eggs->isEmpty) : ?>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div><strong>Eggs</strong></div>
                <div><?=$eggs->filled?></div>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($eggs->slots as $slot) : ?>
                    <li class="list-group-item d-flex align-items-center">
                        <div>
                            <img src="https://archives.bulbagarden.net/media/upload/d/dc/Spr_3r_Egg.png">
                        </div>
                        <div>
                            <div>
                                <span style="font-weight: bold;"><?=$slot->firstParent->name?></span>
                                <?php if ($slot->firstParent->sex === \ConorSmith\Pokemon\Sex::FEMALE) : ?>
                                    <i class="fas fa-venus"></i>
                                <?php elseif ($slot->firstParent->sex === \ConorSmith\Pokemon\Sex::MALE) : ?>
                                    <i class="fas fa-mars"></i>
                                <?php elseif ($slot->firstParent->sex === \ConorSmith\Pokemon\Sex::UNKNOWN) : ?>
                                    <i class="fas fa-genderless"></i>
                                <?php endif ?>
                                and
                                <span style="font-weight: bold;"><?=$slot->secondParent->name?></span>
                                <?php if ($slot->secondParent->sex === \ConorSmith\Pokemon\Sex::FEMALE) : ?>
                                    <i class="fas fa-venus"></i>
                                <?php elseif ($slot->secondParent->sex === \ConorSmith\Pokemon\Sex::MALE) : ?>
                                    <i class="fas fa-mars"></i>
                                <?php elseif ($slot->secondParent->sex === \ConorSmith\Pokemon\Sex::UNKNOWN) : ?>
                                    <i class="fas fa-genderless"></i>
                                <?php endif ?>
                            </div>
                            <div style="font-size: 0.8rem;"><?=$slot->cycles?> cycles remaining</div>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><strong>Day Care</strong></div>
            <div><?=$dayCare->filled?> / <?=$dayCare->maximum?></div>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($dayCare->slots as $slot) : ?>
                <?php $pokemon = $slot->pokemon ?>
                <?php require __DIR__ . "/ListPokemon.php" ?>
                <li class="list-group-item d-flex justify-content-end" style="background: #fafafa;">
                    <div class="d-flex gap-2">
                        <a class="btn btn-outline-dark btn-sm" href="/<?=$instanceId?>/team/member/<?=$slot->pokemon->id?>">
                            Stats
                        </a>
                        <div class="dropdown">
                            <a class="btn btn-outline-dark btn-sm dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                Send
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form method="POST" action="/<?=$instanceId?>/team/send-to-team">
                                        <input type="hidden" name="pokemon" value="<?=$slot->pokemon->id?>">
                                        <button type="submit" class="dropdown-item" <?=$slot->canSendToTeam ? "" : "disabled"?>>
                                            Send to Team
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form method="POST" action="/<?=$instanceId?>/team/send-to-box">
                                        <input type="hidden" name="pokemon" value="<?=$slot->pokemon->id?>">
                                        <button type="submit" class="dropdown-item" <?=$slot->canSendToBox ? "" : "disabled"?>>
                                            Send to Box
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>
            <?php for ($i = $dayCare->filled; $i < $dayCare->maximum; $i++) : ?>
                <li class="list-group-item d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center" style="width: 6rem; height: 5rem; margin-right: 1rem; color: #aaa;">
                        <i class="fas fa-dot-circle"></i>
                    </div>
                    <div>
                        <h5><span style="color: #aaa;">Place Available</span></h5>
                    </div>
                </li>
            <?php endfor ?>
        </ul>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><strong>Box</strong></div>
            <div><?=$box->filled?></div>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($box->slots as $slot) : ?>
                <?php $pokemon = $slot->pokemon ?>
                <?php require __DIR__ . "/ListPokemon.php" ?>
                <li class="list-group-item d-flex justify-content-end" style="background: #fafafa;">
                    <div class="d-flex gap-2">
                        <a class="btn btn-outline-dark btn-sm" href="/<?=$instanceId?>/team/member/<?=$slot->pokemon->id?>">
                            Stats
                        </a>
                        <div class="dropdown">
                            <a class="btn btn-outline-dark btn-sm dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                Send
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form method="POST" action="/<?=$instanceId?>/team/send-to-team">
                                        <input type="hidden" name="pokemon" value="<?=$slot->pokemon->id?>">
                                        <button type="submit" class="dropdown-item" <?=$slot->canSendToTeam ? "" : "disabled"?>>
                                            Send to Team
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form method="POST" action="/<?=$instanceId?>/team/send-to-day-care">
                                        <input type="hidden" name="pokemon" value="<?=$slot->pokemon->id?>">
                                        <button type="submit" class="dropdown-item" <?=$slot->canSendToDayCare ? "" : "disabled"?>>
                                            Send to Day Care
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </div>

</div>
