<form method="POST" action="/map/move" style="height: 100%;">
    <input type="hidden" name="location" value="<?=$location->id?>">
    <button type="submit"
            class="btn btn-primary d-flex align-items-center justify-content-center"
            style="width: 100%; height: 100%; gap: 4px;"
            <?=$location->isLocked ? "disabled" : ""?>
    >
        <?php if ($location->icon) : ?>
            <i class="fa-fw <?=$location->icon?>" style="opacity: 0.8;"></i>
        <?php endif ?>
        <div>
            <?=$location->name?>
            <?php if ($location->section) : ?>
                <span class="badge text-bg-primary"><?=$location->section?></span>
            <?php endif ?>
        </div>
    </button>
</form>
