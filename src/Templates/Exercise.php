<div class="d-grid gap-4" style="text-align: center;">

    <h1>Exercise</h1>

    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger"><?=$error?></div>
    <?php endforeach ?>

    <form method="POST" class="d-grid">
        <input type="hidden" name="date" value="<?=$yesterday?>">
        <button type="submit" class="btn btn-primary btn-lg">
            Exercised Yesterday
            <?php if ($loggedYesterday > 0) : ?>
                <span class="badge text-bg-light"><?=$loggedYesterday?></span>
            <?php endif ?>
        </button>
    </form>

    <form method="POST" class="d-grid">
        <input type="hidden" name="date" value="<?=$today?>">
        <button type="submit" class="btn btn-primary btn-lg">
            Exercised Today
            <?php if ($loggedToday > 0) : ?>
                <span class="badge text-bg-light"><?=$loggedToday?></span>
            <?php endif ?>
        </button>
    </form>

    <form method="POST" class="d-grid gap-2">
        <input type="date" name="date" class="form-control">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
