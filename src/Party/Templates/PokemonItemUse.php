<div class="d-grid gap-4">

    <div class="d-flex justify-content-between align-items-end">
        <h2 class="mb-0">Bag</h2>
        <a href="/<?=$instanceId?>/party/member/<?=$pokemon->id?>" class="btn btn-sm btn-outline-dark">Cancel</a>
    </div>

    <div class="card" style="margin-top: 2rem; padding: 1rem;">
        <div style="text-align: center;">
            Choose item to use on
        </div>
        <div style="text-align: center;">
            <strong><?=$pokemon->name?></strong>
        </div>
    </div>

    <ul class="list-group">

        <?php foreach ($items as $item) : ?>
            <li class="list-group-item d-flex justify-content-between">
                <div class="d-flex">
                    <div class="me-2" style="width: 24px; text-align: center;">
                        <img src="<?=$item->imageUrl?>" style="width: 24px;">
                    </div>
                    <div><?=$item->name?></div>
                </div>
                <div class="d-flex justify-content-between" style="width: 5rem;">
                    <?php if ($item->hasUse) : ?>
                        <form method="POST" action="/<?=$instanceId?>/party/use/<?=$item->id?>">
                            <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                            <input type="hidden" name="redirectUrlPath" value="/<?=$instanceId?>/party/member/<?=$pokemon->id?>/item-use">
                            <button type="submit" class="btn btn-primary btn-sm" <?=$item->amount === 0 ? "disabled" : ""?>>
                                Use
                            </button>
                        </form>
                    <?php else : ?>
                        <span></span>
                    <?php endif ?>
                    <?=$item->amount?>
                </div>
            </li>
        <?php endforeach ?>

    </ul>

    <?php if (count($evolutionItems) > 0) : ?>

        <ul class="list-group">

            <li class="list-group-item d-flex justify-content-between" style="background: #fafafa;">
                <strong>Evolution Items</strong>
            </li>

            <?php foreach ($evolutionItems as $item) : ?>
                <li class="list-group-item d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="me-2" style="width: 24px; text-align: center;">
                            <img src="<?=$item->imageUrl?>">
                        </div>
                        <div><?=$item->name?></div>
                    </div>
                    <div class="d-flex justify-content-between" style="width: 5rem;">
                        <?php if ($item->hasUse) : ?>
                            <form method="POST" action="/<?=$instanceId?>/party/use/<?=$item->id?>">
                                <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                                <input type="hidden" name="redirectUrlPath" value="/<?=$instanceId?>/party/member/<?=$pokemon->id?>/item-use">
                                <button type="submit" class="btn btn-primary btn-sm" <?=$item->amount === 0 ? "disabled" : ""?>>
                                    Use
                                </button>
                            </form>
                        <?php else : ?>
                            <span></span>
                        <?php endif ?>
                        <?=$item->amount?>
                    </div>
                </li>
            <?php endforeach ?>

        </ul>

    <?php endif ?>

    <?php if (count($statsItems) > 0) : ?>

        <ul class="list-group">

            <li class="list-group-item d-flex justify-content-between" style="background: #fafafa;">
                <strong>Stat Boosting Items</strong>
            </li>

            <?php foreach ($statsItems as $item) : ?>
                <li class="list-group-item d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="me-2" style="width: 24px; text-align: center;">
                            <img src="<?=$item->imageUrl?>">
                        </div>
                        <div><?=$item->name?></div>
                    </div>
                    <div class="d-flex justify-content-between" style="width: 5rem;">
                        <?php if ($item->hasUse) : ?>
                            <form method="POST" action="/<?=$instanceId?>/party/use/<?=$item->id?>">
                                <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                                <input type="hidden" name="redirectUrlPath" value="/<?=$instanceId?>/party/member/<?=$pokemon->id?>/item-use">
                                <button type="submit" class="btn btn-primary btn-sm" <?=$item->amount === 0 ? "disabled" : ""?>>
                                    Use
                                </button>
                            </form>
                        <?php else : ?>
                            <span></span>
                        <?php endif ?>
                        <?=$item->amount?>
                    </div>
                </li>
            <?php endforeach ?>

        </ul>

    <?php endif ?>

    <?php if (count($heldItems) > 0) : ?>

        <ul class="list-group">

            <li class="list-group-item d-flex justify-content-between" style="background: #fafafa;">
                <strong>Held Items</strong>
            </li>

            <?php foreach ($heldItems as $item) : ?>
                <li class="list-group-item d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="me-2" style="width: 24px; text-align: center;">
                            <img src="<?=$item->imageUrl?>">
                        </div>
                        <div><?=$item->name?></div>
                    </div>
                    <div class="d-flex justify-content-between" style="width: 5rem;">
                        <?php if ($item->hasUse) : ?>
                            <form method="POST" action="/<?=$instanceId?>/party/use/<?=$item->id?>">
                                <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                                <input type="hidden" name="redirectUrlPath" value="/<?=$instanceId?>/party/member/<?=$pokemon->id?>/item-use">
                                <button type="submit" class="btn btn-primary btn-sm" <?=$item->amount === 0 ? "disabled" : ""?>>
                                    Use
                                </button>
                            </form>
                        <?php else : ?>
                            <span></span>
                        <?php endif ?>
                        <?=$item->amount?>
                    </div>
                </li>
            <?php endforeach ?>

        </ul>

    <?php endif ?>

</div>
