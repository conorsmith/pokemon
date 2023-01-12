<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="container" style="padding-top: 2rem; max-width: 30rem;">

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/map/move">Moves</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/team/level-up">Level Ups</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/map/encounter">Encounters</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <hr>

    <h2 style="text-align: center;">Team</h2>

    <ul class="list-group" style="margin-top: 2rem;">
        <?php foreach ($team as $pokemon) : ?>
            <li class="list-group-item d-flex">
                <img src="<?=$pokemon->imageUrl?>" style="width: 6rem; margin-right: 1rem;">
                <div>
                    <h5><?=$pokemon->name?></h5>
                    <p class="mb-0">Level <?=$pokemon->level?></p>
                </div>
            </li>
        <?php endforeach ?>
    </ul>

    <div class="d-grid gap-2" style="margin-top: 2rem;">

            <a href="/log/food-diary" class="btn btn-primary">Log Completed Food Diary</a>
            <a href="/log/calorie-goal" class="btn btn-primary">Log Attained Calorie Goal</a>
            <a href="/log/exercise" class="btn btn-primary">Log Exercise</a>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
