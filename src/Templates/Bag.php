<div class="d-grid gap-4">

    <h2>Bag</h2>

    <ul class="list-group">

        <?php foreach ($items as $item) : ?>
            <li class="list-group-item d-flex justify-content-between">
                <div class="d-flex">
                    <div class="me-2" style="width: 24px; text-align: center;">
                        <img src="<?=$item->imageUrl?>">
                    </div>
                    <div><?=$item->name?></div>
                </div>
                <div class="d-flex justify-content-between" style="width: 5rem;">
                    <?php if ($item->hasUse) : ?>
                        <form method="POST" action="/item/<?=$item->id?>/use">
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
                            <form method="POST" action="/item/<?=$item->id?>/use">
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
                            <form method="POST" action="/item/<?=$item->id?>/use">
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
