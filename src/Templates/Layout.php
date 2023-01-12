<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/box">Box</a>
                </li>
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

<div class="container" style="padding-top: 2rem; padding-bottom: 2rem; max-width: 30rem;">

    <?=$content?>

</div>

<div class="position-fixed bottom-0 end-0 m-3 d-flex align-items-end">
    <div class="list-group mx-3 d-none" style="box-shadow: 0px 0px 0.6rem 0px rgba(0,0,0,0.3);">
        <a href="/log/food-diary" class="list-group-item list-group-item-action">Log Completed Food Diary</a>
        <a href="/log/calorie-goal" class="list-group-item list-group-item-action">Log Attained Calorie Goal</a>
        <a href="/log/exercise" class="list-group-item list-group-item-action">Log Exercise</a>
    </div>
    <button id="log-menu-button" type="button" class="btn btn-primary btn-lg" style="width: 4rem; height: 4rem; border-radius: 3rem; font-weight: bold; font-size: 2rem; line-height: 1rem; box-shadow: 0px 0px 0.6rem 0px rgba(0,0,0,0.3);"><i class="fas fa-plus"></i></button>
</div>

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
