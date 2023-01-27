<?php foreach ($successes as $success) : ?>
    <div class="alert alert-success"><?=$success?></div>
<?php endforeach ?>

<?php foreach ($errors as $error) : ?>
    <div class="alert alert-danger"><?=$error?></div>
<?php endforeach ?>

<div style="text-align: center;">
    Choose Pokémon on which to use
</div>
<div style="text-align: center;">
    <img src="<?=$item->imageUrl?>"> <strong><?=$item->name?></strong>
</div>

<ul class="list-group" style="margin-top: 2rem;">
    <form method="POST" action="/team/use/<?=$item->id?>">
        <?php foreach ($team as $pokemon) : ?>
            <button type="submit" name="pokemon" value="<?=$pokemon->id?>" class="list-group-item list-group-item-action d-flex">
                <img src="<?=$pokemon->imageUrl?>" style="width: 6rem; margin-right: 1rem;">
                <div>
                    <h5><?=$pokemon->name?></h5>
                    <p class="mb-0">
                        <span>
                            <span class="badge bg-<?=$pokemon->primaryType?>" style="text-transform: uppercase;">
                                <?=$pokemon->primaryType?>
                            </span>
                            <?php if ($pokemon->secondaryType) : ?>
                                <span class="badge bg-<?=$pokemon->secondaryType?>" style="text-transform: uppercase;">
                                    <?=$pokemon->secondaryType?>
                                </span>
                            <?php endif ?>
                        </span>
                        <span style="margin: 0 0.4rem;">
                            Lv <?=$pokemon->level?>
                        </span>
                    </p>
                </div>
            </button>
        <?php endforeach ?>
    </form>
    <div class="d-grid mt-5">
        <a href="/bag" class="btn btn-outline-secondary">Cancel</a>
    </div>
</ul>
