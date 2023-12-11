<div class="d-grid gap-4" style="text-align: center;">

    <h1>Calorie Goal</h1>

    <form method="POST" class="d-grid">
        <input type="hidden" name="date" value="<?=$yesterday?>">
        <button type="submit" class="btn btn-primary btn-lg" <?=$isYesterdayLogged ? "disabled" : ""?>>Attained Yesterday's Calorie Goal</button>
    </form>

    <form method="POST" class="d-grid">
        <input type="hidden" name="date" value="<?=$today?>">
        <button type="submit" class="btn btn-primary btn-lg" <?=$isTodayLogged ? "disabled" : ""?>>Attained Today's Calorie Goal</button>
    </form>

    <form method="POST" class="d-grid gap-2">
        <input type="date" name="date" class="form-control">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <?php foreach ($calendar as $month) : ?>

        <div><strong><?=$month['month']?> <?=$month['year']?></strong></div>

        <table class="table table-bordered">
            <?php foreach ($month['weeks'] as $week) : ?>
                <tr>
                    <?php foreach ($week as $day) : ?>
                        <?php if (is_null($day)) : ?>
                            <td class="empty-cell">
                            </td>
                        <?php else : ?>
                            <td class="date-cell <?=$day['isLogged'] ? "date-cell--is-logged" : ""?>">
                                <?=$day['day']?>
                            </td>
                        <?php endif ?>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>

    <?php endforeach ?>

</div>

<style>
    .date-cell {
        text-align: center;
        width: calc(100% / 7);
    }

    .date-cell.date-cell--is-logged {
        background-color: var(--bs-primary);
        color: #fff;
    }
</style>
