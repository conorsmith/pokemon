<div class="d-grid gap-4">

    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger"><?=$error?></div>
    <?php endforeach ?>

    <?php foreach ($successes as $success) : ?>
        <div class="alert alert-success"><?=$success?></div>
    <?php endforeach ?>

    <h1 style="text-align: center;">Team</h1>

    <ul class="list-group">
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
                <div>
                    <form method="POST" action="/team/send-to-box">
                        <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                        <button type="submit" class="btn btn-outline-dark btn-sm" <?=count($team) === 1 ? "disabled" : ""?>>
                            Send to Box
                        </button>
                    </form>
                </div>
            </li>
        <?php endforeach ?>
    </ul>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><strong>Box</strong></div>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($box as $pokemon) : ?>
                <?php require __DIR__ . "/Pokemon.php" ?>
                <li class="list-group-item d-flex justify-content-end" style="background: #fafafa;">
                    <form method="POST" action="/team/send-to-team">
                        <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                        <button type="submit" class="btn btn-outline-dark btn-sm" <?=count($team) === 6 ? "disabled" : ""?>>Send to Team</button>
                    </form>
                </li>
            <?php endforeach ?>
        </ul>
    </div>

</div>
