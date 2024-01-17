<li class="list-group-item d-flex justify-content-between">
    <div class="d-flex">
        <div class="me-2" style="width: 24px; text-align: center;">
            <img src="<?=$item->imageUrl?>" style="width: 24px;">
        </div>
        <div><?=$item->name?></div>
    </div>
    <div class="d-flex justify-content-between" style="width: 5rem;">
        <?php if ($item->hasUse) : ?>
            <form method="POST" action="<?=$item->useAction->url?>">
                <?php foreach ($item->useAction->hiddenInputs as $name => $value) : ?>
                    <input type="hidden" name="<?=$name?>" value="<?=$value?>">
                <?php endforeach ?>
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
