<div class="d-grid gap-4">

    <h1 style="text-align: center;">Weekly Review</h1>

    <form method="POST" class="d-grid gap-2">

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Aggregate Calorie Goal Misses</label>
            <input type="number" class="form-control" name="total">
        </div>

        <input type="date" name="date" class="form-control" value="<?=$lastMonday?>">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
