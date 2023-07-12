<div style="text-align: center;">
    Choose Pokémon on which to use
</div>
<div style="text-align: center;">
    <img src="<?=$item->imageUrl?>"> <strong><?=$item->name?></strong>
</div>

<ul class="list-group" style="margin-top: 2rem;">
    <form method="POST" action="/<?=$instanceId?>/team/use/<?=$item->id?>" class="stretched-link-form">
        <?php foreach ($team as $pokemon) : ?>
            <?php require __DIR__ . "/../Team/Templates/ListPokemon.php" ?>
        <?php endforeach ?>
    </form>
    <div class="d-grid mt-5">
        <a href="/<?=$instanceId?>/bag" class="btn btn-outline-secondary">Cancel</a>
    </div>
</ul>

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
