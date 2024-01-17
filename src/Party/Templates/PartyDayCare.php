<?php include __DIR__ . "/BottomNav.php" ?>

<div class="d-grid gap-4">

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
                        <a class="btn btn-outline-dark btn-sm" href="/<?=$instanceId?>/party/member/<?=$slot->pokemon->id?>">
                            Stats
                        </a>
                        <div class="dropdown">
                            <a class="btn btn-outline-dark btn-sm dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                Send
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form method="POST" action="/<?=$instanceId?>/party/send-to-party">
                                        <input type="hidden" name="pokemon" value="<?=$slot->pokemon->id?>">
                                        <button type="submit" class="dropdown-item" <?=$slot->canSendToParty ? "" : "disabled"?>>
                                            Send to Party
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form method="POST" action="/<?=$instanceId?>/party/send-to-box">
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

</div>
