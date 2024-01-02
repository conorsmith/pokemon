<div class="d-grid gap-4">

    <h1 style="text-align: center;">Weekly Review</h1>

    <form method="POST" class="d-grid gap-2">

        <div class="mb-3 form-floating">
            <input type="number" class="form-control" name="total" placeholder="0">
            <label for="exampleFormControlInput1" class="form-label">Aggregate Calorie Goal Misses</label>
        </div>

        <div class="mb-3 form-floating">
            <input type="date" name="date" class="form-control" value="<?=$lastMonday?>">
            <label for="exampleFormControlInput1" class="form-label">Week starting</label>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <table class="table">
        <?php foreach ($listOfWeeks->weeks as $week) : ?>
            <tr>
                <td><?=$week->date?></td>
                <td style="text-align: right;"><?=$week->entry?></td>
            </tr>
        <?php endforeach ?>
    </table>

</div>
