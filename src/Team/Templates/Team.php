<div class="d-grid gap-4">

    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger"><?=$error?></div>
    <?php endforeach ?>

    <?php foreach ($successes as $success) : ?>
        <div class="alert alert-success"><?=$success?></div>
    <?php endforeach ?>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><strong>Team</strong></div>
            <div><?=count($team)?> / 6</div>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($team as $i => $pokemon) : ?>
                <?php require __DIR__ . "/Pokemon.php" ?>
                <li class="list-group-item d-flex justify-content-between w-100" style="background: #fafafa;">
                    <div class="d-flex">
                        <form method="POST" action="/team/move-up" style="margin-right: 0.4rem;">
                            <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                            <button type="submit" class="btn btn-outline-dark btn-sm" <?=$i === 0 ? "disabled" : ""?>>
                                <i class="fas fa-fw fa-chevron-up"></i>
                            </button>
                        </form>
                        <form method="POST" action="/team/move-down">
                            <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                            <button type="submit" class="btn btn-outline-dark btn-sm" <?=$i === count($team) - 1 ? "disabled" : ""?>>
                                <i class="fas fa-fw fa-chevron-down"></i>
                            </button>
                        </form>
                    </div>
                    <div class="dropdown">
                        <a class="btn btn-outline-dark btn-sm dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Send
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="/team/send-to-box">
                                    <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                                    <button type="submit" class="dropdown-item" <?=$teamHasSingleRemainingMember ? "disabled" : ""?>>
                                        Send to Box
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form method="POST" action="/team/send-to-day-care">
                                    <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                                    <button type="submit" class="dropdown-item" <?=$teamHasSingleRemainingMember || $dayCareIsFull ? "disabled" : ""?>>
                                        Send to Day Care
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><strong>Day Care</strong></div>
            <div><?=count($dayCare)?> / <?=$dayCareLimit?></div>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($dayCare as $pokemon) : ?>
                <?php require __DIR__ . "/Pokemon.php" ?>
                <li class="list-group-item d-flex justify-content-end" style="background: #fafafa;">
                    <div class="dropdown">
                        <a class="btn btn-outline-dark btn-sm dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Send
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="/team/send-to-team">
                                    <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                                    <button type="submit" class="dropdown-item" <?=$teamIsFull ? "disabled" : ""?>>
                                        Send to Team
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form method="POST" action="/team/send-to-box">
                                    <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                                    <button type="submit" class="dropdown-item">
                                        Send to Box
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endforeach ?>
            <?php for ($i = count($dayCare); $i < $dayCareLimit; $i++) : ?>
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
            <div><?=count($box)?></div>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($box as $pokemon) : ?>
                <?php require __DIR__ . "/Pokemon.php" ?>
                <li class="list-group-item d-flex justify-content-end" style="background: #fafafa;">
                    <div class="dropdown">
                        <a class="btn btn-outline-dark btn-sm dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Send
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="/team/send-to-team">
                                    <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                                    <button type="submit" class="dropdown-item" <?=$teamIsFull ? "disabled" : ""?>>
                                        Send to Team
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form method="POST" action="/team/send-to-day-care">
                                    <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                                    <button type="submit" class="dropdown-item" <?=$dayCareIsFull ? "disabled" : ""?>>
                                        Send to Day Care
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </div>

</div>
