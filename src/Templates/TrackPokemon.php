<style>
    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    @keyframes textBounce {
        0% { transform: scale(0.6); }
        60% { transform: scale(1.2); }
        80% { transform: scale(0.9); }
        100% { transform: scale(1); }
    }

    .tracked-pokemon {
        animation: fadeIn 500ms;
    }
</style>

<div class="d-grid gap-4">

    <div class="d-flex justify-content-between align-items-end">
        <h2 class="mb-0"><?=$currentLocation->name?></h2>
        <a href="/map" class="btn btn-sm btn-outline-dark">Stop Tracking</a>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div>
                <i class="fa-fw me-1 <?=$encounterTypeClasses?>"></i>
                <strong>Tracking Wild Pokémon</strong>
            </div>
            <div class="d-flex" style="text-align: center; gap: 4px;">
                <img src="https://archives.bulbagarden.net/media/upload/9/93/Bag_Pok%C3%A9_Ball_Sprite.png" style="filter: grayscale(1);">
                <span><?=$pokeballs?></span>
            </div>
        </div>
        <div class="card-body d-flex justify-content-center align-items-center gap-2 js-tracked-pokemon-indicator" style="height: 6.5rem;">
            <div class="spinner-grow spinner-grow-sm" style="animation-duration: 1s;"></div>
            <div class="spinner-grow spinner-grow-sm" style="animation-duration: 1s; animation-delay: 150ms;"></div>
            <div class="spinner-grow spinner-grow-sm" style="animation-duration: 1s; animation-delay: 300ms;"></div>
        </div>
        <div class="card-body d-none justify-content-center align-items-center js-tracked-pokemon-alert" style="height: 6.5rem;">
            <i class="fas fa-exclamation" style="font-size: 3rem; animation: textBounce 500ms;"></i>
        </div>
        <div class="card-body d-none justify-content-center align-items-center js-tracked-pokemon-message" style="height: 6.5rem; font-weight: bold;"></div>
        <div class="card-body d-flex flex-column gap-2 js-tracked-pokemon-container">
        </div>
    </div>

</div>

<script type="application/json" id="script-data"><?=$scriptData?></script>
<script>
    const scriptData = JSON.parse(document.getElementById("script-data").innerText);

    const indicatorDelay = 1500;

    const el = document.querySelector(".js-tracked-pokemon-container");

    const indicatorEl = document.querySelector(".js-tracked-pokemon-indicator");
    const alertEl = document.querySelector(".js-tracked-pokemon-alert");
    const messageEl = document.querySelector(".js-tracked-pokemon-message");

    const formData = new FormData();
    formData.append("encounterType", scriptData.encounterType);

    requestTrackedPokemon();

    function requestTrackedPokemon() {
        fetch(new Request(
            "/encounter/generate",
            {
                method: "POST",
                body: formData
            }
        ))
            .then(response => response.json())
            .then(responseData => {

                el.style.opacity = 0.5;
                el.querySelectorAll(".js-tracked-pokemon").forEach(function (el) {
                    el.dataset.isDisabled = true;
                });

                indicatorEl.classList.replace("d-flex", "d-none");
                alertEl.classList.replace("d-none", "d-flex");

                setTimeout(function () {

                    el.style.removeProperty("opacity");
                    el.querySelectorAll(".js-tracked-pokemon").forEach(function (el) {
                        delete el.dataset.isDisabled;
                    });

                    let div = document.createElement('div');
                    if (responseData.isRegistered) {
                        div.innerHTML = renderTrackedPokemon(responseData.id, responseData.pokemon).trim();
                    } else {
                        div.innerHTML = renderUnregisteredTrackedPokemon(responseData.id, responseData.pokemon).trim();
                    }

                    el.prepend(div.firstChild);
                    if (el.children.length > 9) {
                        el.lastChild.remove();
                    }

                    if (responseData.isRegistered) {
                        messageEl.innerText = "It's a wild " + responseData.pokemon.name + "!";
                    } else {
                        messageEl.innerText = "Who's that Pokémon!?";
                    }

                    el.firstChild.classList.replace("d-none", "d-flex");
                    alertEl.classList.replace("d-flex", "d-none");
                    messageEl.classList.replace("d-none", "d-flex");
                    setTimeout(function () {
                        indicatorEl.classList.replace("d-none", "d-flex");
                        messageEl.classList.replace("d-flex", "d-none");
                    }, indicatorDelay);

                    el.firstChild.addEventListener("click", function (e) {
                        if (e.currentTarget.dataset.isDisabled) {
                            e.preventDefault();
                            return;
                        }

                        e.currentTarget.submit();
                        e.preventDefault();
                    })

                    const speedRand = Math.floor(Math.random() * (10 - 1 + 1) + 1);
                    const slowRand = Math.floor(Math.random() * (10 - 1 + 1) + 1);
                    const fastRand = Math.floor(Math.random() * (3 - 1 + 1) + 1);
                    const rand = speedRand > 7 ? slowRand : fastRand;

                    setTimeout(requestTrackedPokemon, Math.max(indicatorDelay, rand  * 1000));
                }, 1000);
            });
    }

    function renderTrackedPokemon(encounterId, pokemon) {

        let formElement = "";
        if (pokemon.form !== null) {
            formElement = `
                <span class="badge bg-secondary" style="font-size: 0.8rem;">${pokemon.form} Form</span>
            `;
        }

        let secondaryTypeElement = "";
        if (pokemon.secondaryType !== null) {
            secondaryTypeElement = `
                <span class="badge bg-${pokemon.secondaryType}" style="text-transform: uppercase;">
                    ${pokemon.secondaryType}
                </span>
            `;
        }

        return `
            <form method="POST" action="/encounter/${encounterId}/start" class="d-none tracked-pokemon js-tracked-pokemon">
                <div class="pokemon-image pokemon-image--encounter ${pokemon.isShiny ? "pokemon-image--shiny" : "" }">
                    <img src="${pokemon.imageUrl}">
                </div>
                <div style="flex-grow: 1;">
                    <h5>
                        ${pokemon.name}
                        ${formElement}
                    </h5>
                    <div class="mb-3 d-flex">
                        <span>
                            <span class="badge bg-${pokemon.primaryType}" style="text-transform: uppercase;">
                                ${pokemon.primaryType}
                            </span>
                            ${secondaryTypeElement}
                        </span>
                        <span class="pokemon-level">
                            Lv ${pokemon.level}
                        </span>
                    </div>
                </div>
            </form>
        `;
    }

    function renderUnregisteredTrackedPokemon(encounterId, pokemon) {

        return `
            <form method="POST" action="/encounter/${encounterId}/start" class="d-none tracked-pokemon js-tracked-pokemon" style="transition: opacity 0.5s;">
                <div class="pokemon-image pokemon-image--encounter pokemon-image--unregistered ${pokemon.isShiny ? "pokemon-image--shiny" : "" }">
                    <img src="${pokemon.imageUrl}">
                </div>
                <div style="flex-grow: 1;">
                    <h5>
                        ???
                    </h5>
                    <div class="mb-3 d-flex">
                        <span>
                            <span class="badge" style="text-transform: uppercase; background-color: #aaa; color: #fff;">
                                ???
                            </span>
                        </span>
                        <span class="pokemon-level">
                            Lv ${pokemon.level}
                        </span>
                    </div>
                </div>
            </form>
        `;
    }
</script>

