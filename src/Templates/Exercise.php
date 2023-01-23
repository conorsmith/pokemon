<div class="d-grid gap-4" style="text-align: center;">

    <h1>Exercise</h1>

    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger"><?=$error?></div>
    <?php endforeach ?>

    <form method="POST">

        <div class="btn-group-vertical btn-group-lg d-flex mb-4">
            <input type="radio" class="btn-check" name="type" value="short-walk" id="option1" autocomplete="off" checked>
            <label class="btn btn-outline-primary" for="option1"><i class="fas fa-fw fa-walking"></i> Short Walk</label>

            <input type="radio" class="btn-check" name="type" value="long-walk" id="option2" autocomplete="off">
            <label class="btn btn-outline-primary" for="option2"><i class="fas fa-fw fa-hiking"></i> Long Walk</label>

            <input type="radio" class="btn-check" name="type" value="run" id="option3" autocomplete="off">
            <label class="btn btn-outline-primary" for="option3"><i class="fas fa-fw fa-running"></i> Run</label>
        </div>

        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-primary btn-lg" name="date" value="<?=$yesterday?>">
                Exercised Yesterday
                <?php if ($loggedYesterday > 0) : ?>
                    <span class="badge text-bg-light"><?=$loggedYesterday?></span>
                <?php endif ?>
            </button>
        </div>

        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-primary btn-lg" name="date" value="<?=$today?>">
                Exercised Today
                <?php if ($loggedToday > 0) : ?>
                    <span class="badge text-bg-light"><?=$loggedToday?></span>
                <?php endif ?>
            </button>
        </div>

        <div class="d-grid gap-2">
            <input type="date" name="earlier_date" class="form-control">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

</div>
