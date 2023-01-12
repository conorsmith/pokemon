<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="container d-grid gap-4" style="padding-top: 2rem; max-width: 30rem; text-align: center;">

    <h1>Map</h1>

    <div class="card" style="text-align: center;">
        <div class="card-header">
            <h3 class="mb-0"><?=$currentLocation->name?></h3>
        </div>
        <div class="card-body">
            <strong><?=$unusedMoves?></strong> unused moves
        </div>
    </div>

    <div class="d-grid gap-2">

        <?php foreach ($currentLocation->directions as $location) : ?>

            <form method="POST" class="d-grid">
                <input type="hidden" name="location" value="<?=$location->id?>">
                <button type="submit" class="btn btn-primary btn-lg" <?=$unusedMoves === 0 ? "disabled" : ""?>>Move to <?=$location->name?></button>
            </form>

        <?php endforeach ?>

    </div>

    <a href="/" class="btn btn-outline-secondary btn-sm">Home</a>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
