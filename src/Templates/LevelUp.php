<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="container d-grid gap-4" style="padding-top: 2rem; max-width: 30rem;">

    <h1 style="text-align: center;">Team</h1>

    <div class="card" style="text-align: center;">
        <div class="card-body">
            <strong><?=$unusedLevelUps?></strong> unused level ups
        </div>
    </div>

    <ul class="list-group">
        <?php foreach ($team as $pokemon) : ?>
            <li class="list-group-item d-flex">
                <img src="<?=$pokemon->imageUrl?>" style="width: 6rem; margin-right: 1rem;">
                <div>
                    <h5><?=$pokemon->name?></h5>
                    <p class="mb-0">Level <?=$pokemon->level?></p>
                    <?php if ($unusedLevelUps > 0) : ?>
                        <form method="POST" style="margin-top: 1rem;">
                            <input type="hidden" name="pokemon" value="<?=$pokemon->id?>">
                            <button type="submit" class="btn btn-primary btn-sm">Level Up!</button>
                        </form>
                    <?php endif ?>
                </div>
            </li>
        <?php endforeach ?>
    </ul>

    <a href="/" class="btn btn-outline-secondary btn-sm">Home</a>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
