<div class="d-grid gap-4">

    <div class="d-flex justify-content-between align-items-end">
        <h2 class="mb-0">Breeding</h2>
        <a href="/<?=$instanceId?>/bag" class="btn btn-sm btn-outline-dark">Cancel</a>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><strong>Selected Pokémon</strong></div>
        </div>
        <ul class="list-group list-group-flush">
            <?php require __DIR__ . "/ListBreedingPokemon.php" ?>
        </ul>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><strong>Compatible Partners</strong></div>
        </div>
        <form method="POST" action="/<?=$instanceId?>/team/member/<?=$pokemon->id?>/breed" class="stretched-link-form">
            <ul class="list-group list-group-flush">
                <?php foreach ($partners as $pokemon) : ?>
                    <?php require __DIR__ . "/ListBreedingPokemon.php" ?>
                <?php endforeach ?>
            </ul>
        </form>
    </div>

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
