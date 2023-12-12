<div class="d-grid gap-4" style="text-align: center;">

    <h1>Stretches</h1>

    <form method="POST" class="d-grid">
        <input type="hidden" name="date" value="<?=$yesterday?>">
        <button type="submit" class="btn btn-primary btn-lg" <?=$isYesterdayLogged ? "disabled" : ""?>>Completed Yesterday's Stretches</button>
    </form>

    <form method="POST" class="d-grid">
        <input type="hidden" name="date" value="<?=$today?>">
        <button type="submit" class="btn btn-primary btn-lg" <?=$isTodayLogged ? "disabled" : ""?>>Completed Today's Stretches</button>
    </form>

    <form method="POST" class="d-grid gap-2">
        <input type="date" name="date" class="form-control">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <?php include __DIR__ . "/Calendar.php" ?>

</div>
