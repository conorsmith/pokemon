<div class="d-grid gap-4">

    <h1 style="text-align: center;">Bag</h1>

    <ul class="list-group">

        <?php foreach ($items as $item) : ?>
            <li class="list-group-item d-flex justify-content-between">
                <div class="d-flex">
                    <div class="me-2" style="width: 24px; text-align: center;">
                        <img src="<?=$item->imageUrl?>">
                    </div>
                    <div><?=$item->name?></div>
                </div>
                <div><?=$item->amount?></div>
            </li>
        <?php endforeach ?>

    </ul>

</div>
