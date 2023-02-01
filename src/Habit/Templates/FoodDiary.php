<div class="d-grid gap-4" style="text-align: center;">

    <h1>Food Diary</h1>

    <div>
        <strong><?=$streak?></strong> day streak
    </div>

    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger"><?=$error?></div>
    <?php endforeach ?>

    <form method="POST" class="d-grid">
        <input type="hidden" name="date" value="<?=$yesterday?>">
        <button type="submit" class="btn btn-primary btn-lg" <?=$isYesterdayLogged ? "disabled" : ""?>>Completed Yesterday's Food Diary</button>
    </form>

    <form method="POST" class="d-grid">
        <input type="hidden" name="date" value="<?=$today?>">
        <button type="submit" class="btn btn-primary btn-lg" <?=$isTodayLogged ? "disabled" : ""?>>Completed Today's Food Diary</button>
    </form>

    <form method="POST" class="d-grid gap-2">
        <input type="date" name="date" class="form-control">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
