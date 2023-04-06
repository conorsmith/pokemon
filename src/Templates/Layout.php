<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <style>
        .bg-normal {
            background: #A8A878;
        }
        .bg-fighting {
            background: #C03028;
        }
        .bg-flying {
            background: #A890F0;
        }
        .bg-poison {
            background: #A040A0;
        }
        .bg-ground {
            background: #E0C068;
        }
        .bg-rock {
            background: #B8A038;
        }
        .bg-bug {
            background: #A8B820;
        }
        .bg-ghost {
            background: #705898;
        }
        .bg-steel {
            background: #B8B8D0;
        }
        .bg-fire {
            background: #F08030;
        }
        .bg-water {
            background: #6890F0;
        }
        .bg-grass {
            background: #78C850;
        }
        .bg-electric {
            background: #F8D030;
        }
        .bg-psychic {
            background: #F85888;
        }
        .bg-ice {
            background: #98D8D8;
        }
        .bg-dragon {
            background: #7038F8;
        }
        .bg-dark {
            background: #705848;
        }
        .bg-fairy {
            background: #EE99AC;
        }

        .badge-addendum {
            margin-left: 0.4rem; padding-left: 0.4rem; border-left: 1px #fff solid;
        }

        .pokemon-image {
            width: 6rem;
            margin-right: 1rem;
        }
        .flex-row-reverse .pokemon-image {
            margin-right: 0;
            margin-left: 1rem;
        }
        .pokemon-image img {
            width: 100%;
        }
        .pokemon-image.pokemon-image--shiny img {
            filter: hue-rotate(180deg);
        }
        .pokemon-image.pokemon-image--shiny.pokemon-image--encounter img {
            animation-name: flash;
            animation-duration: 0.5s;
            animation-fill-mode: both;
            animation-iteration-count: 3;
        }

        @keyframes flash {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.4;
            }
        }

        .stretched-link--hidden {
            width: 0;
            height: 0;
            overflow: hidden;
        }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Pokémon</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/team">Team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/bag">Bag</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pokedex">Pokédex</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/map">Map</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container" style="padding-top: 2rem; padding-bottom: 6rem; max-width: 30rem;">

    <?=$content?>

</div>

<div class="position-fixed bottom-0 end-0 m-3 d-flex align-items-end" style="z-index: 2;">
    <div class="list-group mx-3 d-none" style="box-shadow: 0px 0px 0.6rem 0px rgba(0,0,0,0.3);">
        <a href="/log/food-diary" class="list-group-item list-group-item-action">Log Completed Food Diary</a>
        <a href="/log/calorie-goal" class="list-group-item list-group-item-action">Log Attained Calorie Goal</a>
        <a href="/log/exercise" class="list-group-item list-group-item-action">Log Exercise</a>
        <a href="/log/weekly-review" class="list-group-item list-group-item-action">Log Weekly Review</a>
    </div>
    <button id="log-menu-button" type="button" class="btn btn-primary btn-lg" style="width: 4rem; height: 4rem; border-radius: 3rem; font-weight: bold; font-size: 2rem; line-height: 1rem; box-shadow: 0px 0px 0.6rem 0px rgba(0,0,0,0.3);"><i class="fas fa-plus"></i></button>
</div>

<?php if ($successes || $failures) : ?>
    <div class="position-fixed top-0 w-100 px-3 pt-3">
        <?php if ($successes) : ?>
            <div class="alert alert-success">
                <?php if (count($successes) === 1) : ?>
                    <?=$successes[0]?>
                <?php else : ?>
                    <ul class="mb-0">
                        <?php foreach ($successes as $success) : ?>
                            <li><?=$success?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>
        <?php endif ?>
        <?php if ($failures) : ?>
            <div class="alert alert-danger">
                <?php if (count($failures) === 1) : ?>
                    <?=$failures[0]?>
                <?php else : ?>
                    <ul class="mb-0">
                        <?php foreach ($failures as $failure) : ?>
                            <li><?=$failure?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>
        <?php endif ?>
    </div>
<?php endif ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
    document.getElementById("log-menu-button").addEventListener("click", function (e) {
        let menu = e.currentTarget.parentNode.querySelector(".list-group");
        if (menu.classList.contains("d-none")) {
            menu.classList.remove("d-none");
        } else {
            menu.classList.add("d-none");
        }
    });
</script>
</body>
</html>
