<div class="d-flex justify-content-between align-items-end">
    <h2 class="mb-0">Bag</h2>
    <a href="/<?=$instanceId?>/bag" class="btn btn-sm btn-outline-dark">Cancel</a>
</div>

<div class="card" style="margin-top: 2rem; padding: 1rem;">
    <div style="text-align: center;">
        Choose Pokémon on which to use
    </div>
    <div style="text-align: center;">
        <img src="<?=$item->imageUrl?>"> <strong><?=$item->name?></strong>
    </div>
</div>

<div class="card" style="margin-top: 2rem;">
    <div class="card-header d-flex justify-content-between" style="border-bottom: 0;">
        <div><strong>Party</strong></div>
    </div>
    <ul class="list-group list-group-flush">
        <form method="POST" action="/<?=$instanceId?>/party/use/<?=$item->id?>" class="stretched-link-form">
            <?php foreach ($party as $pokemon) : ?>
                <?php require __DIR__ . "/ListPokemon.php" ?>
            <?php endforeach ?>
        </form>
    </ul>
</div>

<?php if (count($dayCare) > 0) : ?>
    <div class="card" style="margin-top: 2rem;">
        <div class="card-header d-flex justify-content-between" style="border-bottom: 0;">
            <div><strong>Day Care</strong></div>
        </div>
        <ul class="list-group list-group-flush">
            <form method="POST" action="/<?=$instanceId?>/party/use/<?=$item->id?>" class="stretched-link-form">
                <?php foreach ($dayCare as $pokemon) : ?>
                    <?php require __DIR__ . "/ListPokemon.php" ?>
                <?php endforeach ?>
            </form>
        </ul>
    </div>
<?php endif ?>

<?php if (count($box) > 0) : ?>
    <div class="card" style="margin-top: 2rem;">
        <div class="card-header d-flex justify-content-between" style="border-bottom: 0;">
            <div><strong>Box</strong></div>
        </div>
        <ul class="list-group list-group-flush">
            <form method="POST" action="/<?=$instanceId?>/party/use/<?=$item->id?>" class="stretched-link-form">
                <?php foreach ($box as $pokemon) : ?>
                    <?php require __DIR__ . "/ListPokemon.php" ?>
                <?php endforeach ?>
            </form>
        </ul>
    </div>
<?php endif ?>

<div style="text-align: center; font-size: 0.8rem; padding: 0.6rem; margin-top: 2rem;">
    Powered by <a href="https://sunrisesunset.io/" target="_blank">SunriseSunset.io</a>
</div>

<script>
    document.querySelectorAll(".stretched-link-form").forEach(formEl => {
        formEl.querySelectorAll(".stretched-link").forEach(el => {
            el.addEventListener("click", e => {
                e.preventDefault();

                let inputEl = document.createElement("input");
                inputEl.type = "hidden";
                inputEl.name = "pokemon";
                inputEl.value = e.target.dataset.id;
                formEl.append(inputEl);

                formEl.submit();
            });
        });
    });
</script>
