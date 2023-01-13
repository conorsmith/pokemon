<div class="d-grid gap-4">

    <h1 style="text-align: center;">Manage Team</h1>

    <ul class="list-group">
        <?php foreach ($team as $i => $pokemon) : ?>
            <li class="list-group-item d-flex">
                <img src="<?=$pokemon->imageUrl?>" style="width: 6rem; margin-right: 1rem;">
                <div class="flex-grow-1">
                    <h5><?=$pokemon->name?></h5>
                    <p class="mb-0">Level <?=$pokemon->level?></p>
                    <div class="d-flex justify-content-between w-100" style="margin-top: 1rem;">
                        <div class="d-flex">
                            <form method="POST" action="/team/move-up" style="margin-right: 0.4rem;">
                                <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                                <button type="submit" class="btn btn-outline-dark btn-sm" <?=$i === 0 ? "disabled" : ""?>><i class="fas fa-fw fa-chevron-up"></i></button>
                            </form>
                            <form method="POST" action="/team/move-down">
                                <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                                <button type="submit" class="btn btn-outline-dark btn-sm" <?=$i === count($team) - 1 ? "disabled" : ""?>><i class="fas fa-fw fa-chevron-down"></i></button>
                            </form>
                        </div>
                        <div>
                            <form method="POST" action="/team/send-to-box">
                                <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                                <button type="submit" class="btn btn-outline-dark btn-sm" disabled>Send to Box</button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>

    <h2 style="text-align: center;">Box</h2>

    <ul class="list-group">
        <?php foreach ($box as $pokemon) : ?>
            <li class="list-group-item d-flex">
                <img src="<?=$pokemon->imageUrl?>" style="width: 6rem; margin-right: 1rem;">
                <div>
                    <h5><?=$pokemon->name?></h5>
                    <p class="mb-0">Level <?=$pokemon->level?></p>
                </div>
            </li>
        <?php endforeach ?>
    </ul>

</div>
