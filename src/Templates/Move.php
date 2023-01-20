<div class="d-grid gap-4" style="text-align: center;">

    <h1>Map</h1>

    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger"><?=$error?></div>
    <?php endforeach ?>

    <div class="card" style="text-align: center;">
        <div class="card-header">
            <h3 class="mb-0"><?=$currentLocation->name?></h3>
        </div>

        <?php if ($currentLocation->hasCardinalDirections) : ?>
        
            <div class="card-body d-grid gap-2" style="grid-template-columns: repeat(3, 1fr); grid-auto-rows: 1fr; align-items: stretch;">

                <div></div>
                <div>
                    <?php if (isset($currentLocation->north)) : ?>
                        <form method="POST" style="height: 100%;">
                            <input type="hidden" name="location" value="<?=$currentLocation->north->id?>">
                            <button type="submit" class="btn btn-primary" style="width: 100%; height: 100%;"><?=$currentLocation->north->name?></button>
                        </form>
                    <?php else : ?>
                        <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                    <?php endif ?>
                </div>
                <div></div>

                <div>
                    <?php if (isset($currentLocation->west)) : ?>
                        <form method="POST" style="height: 100%;">
                            <input type="hidden" name="location" value="<?=$currentLocation->west->id?>">
                            <button type="submit" class="btn btn-primary" style="width: 100%; height: 100%;"><?=$currentLocation->west->name?></button>
                        </form>
                    <?php else : ?>
                        <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                    <?php endif ?>
                </div>
                <div style="display: flex; justify-content: center; align-items: center; min-height: 37.6px;">
                    <?=$currentLocation->name?>
                </div>
                <div>
                    <?php if (isset($currentLocation->east)) : ?>
                        <form method="POST" style="height: 100%;">
                            <input type="hidden" name="location" value="<?=$currentLocation->east->id?>">
                            <button type="submit" class="btn btn-primary" style="width: 100%; height: 100%;"><?=$currentLocation->east->name?></button>
                        </form>
                    <?php else : ?>
                        <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                    <?php endif ?>
                </div>

                <div></div>
                <div>
                    <?php if (isset($currentLocation->south)) : ?>
                        <form method="POST" style="height: 100%;">
                            <input type="hidden" name="location" value="<?=$currentLocation->south->id?>">
                            <button type="submit" class="btn btn-primary" style="width: 100%; height: 100%;"><?=$currentLocation->south->name?></button>
                        </form>
                    <?php else : ?>
                        <div style="width: 100%; height: 100%; border-radius: 6px; background-color: rgba(0, 0, 0, 0.03);"></div>
                    <?php endif ?>
                </div>
                <div></div>
            </div>

        <?php endif ?>

        <?php if ($currentLocation->directions && $currentLocation->hasCardinalDirections) : ?>

            <hr class="m-0">

        <?php endif ?>

        <?php if ($currentLocation->directions) : ?>

            <div class="card-body d-grid gap-2 p-2">

                <?php foreach ($currentLocation->directions as $location) : ?>

                    <form method="POST" class="d-grid">
                        <input type="hidden" name="location" value="<?=$location->id?>">
                        <button type="submit" class="btn btn-primary"><?=$location->name?></button>
                    </form>

                <?php endforeach ?>

            </div>

        <?php endif ?>

    </div>

</div>
