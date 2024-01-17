<?php include __DIR__ . "/BottomNav.php" ?>

<div class="d-grid gap-4">

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
                                    <form method="POST" action="/<?=$instanceId?>/party/send-to-day-care">
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
