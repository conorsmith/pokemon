<div class="d-grid gap-4">

    <h1 style="text-align: center;">Pokédex</h1>

    <ul class="list-group">

        <li class="list-group-item p-3" style="text-align: center;">
            <strong><?=$count?></strong> entries
        </li>

        <?php $previousNumber = null ?>
        <?php foreach ($pokedex as $number => $pokemon) : ?>
            <?php if ($number !== $previousNumber + 1) : ?>
                <li class="list-group-item" style="text-align: center; color: #aaa;">
                    <i class="fas fa-ellipsis-v"></i>
                </li>
            <?php endif ?>
            <li class="list-group-item d-flex">
                <?php if ($pokemon) : ?>
                    <div class="pokemon-image">
                        <img src="<?=$pokemon->imageUrl?>">
                    </div>
                    <div class="flex-grow-1">
                        <h5>
                            <span style="color: #888;">#<?=$number?></span>
                            <?=$pokemon->name?>
                        </h5>
                        <p class="mb-0">
                            <span>
                                <span class="badge bg-<?=$pokemon->primaryType?>" style="text-transform: uppercase;">
                                    <?=$pokemon->primaryType?>
                                </span>
                                <?php if ($pokemon->secondaryType) : ?>
                                    <span class="badge bg-<?=$pokemon->secondaryType?>" style="text-transform: uppercase;">
                                        <?=$pokemon->secondaryType?>
                                    </span>
                                <?php endif ?>
                            </span>
                        </p>
                    </div>
                <?php else : ?>
                    <div class="d-flex align-items-center justify-content-center" style="width: 6rem; height: 5rem; margin-right: 1rem; color: #aaa;">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div>
                        <h5><span style="color: #aaa;">#<?=$number?></span></h5>
                        <p class="mb-0">
                            <span class="badge" style="text-transform: uppercase; background-color: #aaa; color: #fff;">
                                ???
                            </span>
                        </p>
                    </div>
                <?php endif ?>
            </li>
            <?php if ($pokemon && $pokemon->hasMultipleForms) : ?>
                <li class="list-group-item d-flex justify-content-around w-100 js-pokedex-forms-show" data-pokedex-number="<?=$number?>" style="background: #fafafa;">
                    <a class="btn btn-outline-dark btn-sm" href="#">
                        See all <?=$pokemon->name?> forms
                    </a>
                </li>
                <li class="list-group-item d-none justify-content-around w-100 js-pokedex-forms-hide" data-pokedex-number="<?=$number?>" style="background: #fafafa;">
                    <a class="btn btn-outline-dark btn-sm" href="#">
                        Hide all <?=$pokemon->name?> forms
                    </a>
                </li>
                <?php foreach ($pokemon->forms as $form) : ?>
                    <li class="list-group-item d-none js-pokedex-forms-entry" data-pokedex-number="<?=$number?>" style="background: #fafafa;">
                        <?php if ($form) : ?>
                            <div class="pokemon-image">
                                <img src="<?=$form->imageUrl?>">
                            </div>
                            <div class="flex-grow-1">
                                <h5>
                                    <span style="color: #888;">#<?=$number?></span>
                                    <?=$form->name?>
                                    <span class="badge bg-secondary" style="font-size: 0.8rem;"><?=$form->form?> Form</span>
                                </h5>
                                <p class="mb-0">
                                <span>
                                    <span class="badge bg-<?=$form->primaryType?>" style="text-transform: uppercase;">
                                        <?=$form->primaryType?>
                                    </span>
                                    <?php if ($form->secondaryType) : ?>
                                        <span class="badge bg-<?=$form->secondaryType?>" style="text-transform: uppercase;">
                                            <?=$form->secondaryType?>
                                        </span>
                                    <?php endif ?>
                                </span>
                                </p>
                            </div>
                        <?php else : ?>
                            <div class="d-flex align-items-center justify-content-center" style="width: 6rem; height: 5rem; margin-right: 1rem; color: #aaa;">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <div>
                                <h5>
                                    <span style="color: #aaa;">#<?=$number?></span>
                                    <span style="color: #aaa;"><?=$pokemon->name?></span>
                                    <span class="badge" style="font-size: 0.8rem; background-color: #aaa; color: #fff;">??? Form</span>
                                </h5>
                                <p class="mb-0">
                                <span class="badge" style="text-transform: uppercase; background-color: #aaa; color: #fff;">
                                    ???
                                </span>
                                </p>
                            </div>
                        <?php endif ?>
                    </li>
                <?php endforeach ?>
            <?php endif ?>
            <?php $previousNumber = $number ?>
        <?php endforeach ?>
    </ul>

</div>

<script>
    document.querySelectorAll(".js-pokedex-forms-show").forEach(function (el) {
        el.querySelector(".btn").addEventListener("click", function (e) {
            const pokedexNumber = el.dataset.pokedexNumber;

            el.classList.add("d-none");
            el.classList.remove("d-flex");

            const hideEl = document.querySelector(".js-pokedex-forms-hide[data-pokedex-number='" + pokedexNumber + "']");
            hideEl.classList.add("d-flex");
            hideEl.classList.remove("d-none");

            document.querySelectorAll(".js-pokedex-forms-entry[data-pokedex-number='" + pokedexNumber + "']").forEach(function (entryEl) {
                entryEl.classList.add("d-flex");
                entryEl.classList.remove("d-none");
            });

            e.preventDefault();
        });
    });

    document.querySelectorAll(".js-pokedex-forms-hide").forEach(function (el) {
        el.querySelector(".btn").addEventListener("click", function (e) {
            const pokedexNumber = el.dataset.pokedexNumber;

            el.classList.add("d-none");
            el.classList.remove("d-flex");

            const showEl = document.querySelector(".js-pokedex-forms-show[data-pokedex-number='" + pokedexNumber + "']");
            showEl.classList.add("d-flex");
            showEl.classList.remove("d-none");

            document.querySelectorAll(".js-pokedex-forms-entry[data-pokedex-number='" + pokedexNumber + "']").forEach(function (entryEl) {
                entryEl.classList.add("d-none");
                entryEl.classList.remove("d-flex");
            });

            e.preventDefault();
        });
    });
</script>
