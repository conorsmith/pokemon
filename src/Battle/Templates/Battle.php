<script>
    document.addEventListener("DOMContentLoaded", function () {

        function processNextEvent(responseData, fnCallback) {
            if (responseData.length === 0) {
                fnCallback();
                return;
            }

            const event = responseData.shift();
            console.log(event);

            if (event.type === "message") {
                const messageEl = document.createElement("li");
                messagesEl.querySelector("ul").appendChild(messageEl);
                typeWriter(messagesEl.querySelector("ul").lastChild, event.value, 0, function () {
                    processNextEvent(responseData, fnCallback);
                });

            } else if (event.type === "damage") {
                const target = document.querySelector("[data-target-id='" + event.target + "'");
                target.querySelector(".progress-bar").classList.remove("transition-disabled");
                target.querySelector(".progress-bar").style.width = (event.value.remaining / event.value.total * 100) + "%";
                target.querySelector(".js-remaining-hp").innerText = event.value.remaining;
                processNextEvent(responseData, fnCallback);

            } else if (event.type === "fainting") {
                const target = document.querySelector("[data-target-id='" + event.target + "'");

                target.querySelector(".pokemon-image").addEventListener("animationend", function () {
                    console.log(event.next);

                    if (!event.isPlayerPokemon) {
                        const firstFilledIcon = document.querySelector(".js-trainer-team .fas");
                        firstFilledIcon.classList.add("far");
                        firstFilledIcon.classList.remove("fas");
                    }

                    if (event.next === null) {
                        document.querySelectorAll(".js-interaction-container > *").forEach(function (el) {
                            if (el.classList.contains("d-none")) {
                                el.classList.remove("d-none");
                            } else {
                                el.classList.add("d-none");
                            }
                        });

                        processNextEvent(responseData, fnCallback);
                        return;
                    }

                    target.dataset.targetId = event.next.id;
                    target.querySelector("h5").innerText = event.next.name;

                    target.querySelector(".pokemon-image img").src = event.next.imageUrl;
                    target.querySelector(".pokemon-image img").addEventListener("load", function (e) {
                        target.querySelector(".pokemon-image").classList.remove("slide-down");
                    });
                    if (event.next.isShiny) {
                        target.querySelector(".pokemon-image").classList.add("pokemon-image--shiny");
                    } else {
                        target.querySelector(".pokemon-image").classList.remove("pokemon-image--shiny");
                    }

                    target.querySelector(".js-types").innerHTML = "";

                    const primaryTypeEl = document.createElement("span");
                    primaryTypeEl.classList.add("badge");
                    primaryTypeEl.classList.add("bg-" + event.next.primaryType);
                    primaryTypeEl.style.textTransform = "uppercase";
                    primaryTypeEl.innerText = event.next.primaryType;
                    target.querySelector(".js-types").appendChild(primaryTypeEl);

                    if (event.next.secondaryType) {
                        target.querySelector(".js-types").appendChild(document.createTextNode(" "));

                        const secondaryTypeEl = document.createElement("span");
                        secondaryTypeEl.classList.add("badge");
                        secondaryTypeEl.classList.add("bg-" + event.next.secondaryType);
                        secondaryTypeEl.style.textTransform = "uppercase";
                        secondaryTypeEl.innerText = event.next.secondaryType;
                        target.querySelector(".js-types").appendChild(secondaryTypeEl);
                    }

                    target.querySelector(".js-level").innerHTML = "Lv " + event.next.level;

                    target.querySelector(".progress-bar").classList.add("transition-disabled");
                    target.querySelector(".progress-bar").style.width = "100%";

                    target.querySelector(".js-remaining-hp").innerText = event.next.remainingHp;
                    target.querySelector(".js-total-hp").innerText = event.next.totalHp;

                    processNextEvent(responseData, fnCallback);
                }, {
                    once: true
                });

                target.querySelector(".pokemon-image").classList.add("slide-down");

            } else {
                processNextEvent(responseData, fnCallback);
            }
        }

        // type one text in the typwriter
        // keeps calling itself until the text is finished
        function typeWriter(target, text, i, fnCallback) {
            // chekc if text isn't finished yet
            if (i < (text.length)) {
                // add next character to h1
                target.innerHTML = text.substring(0, i+1);

                // wait for a while and call this function again for next character
                setTimeout(function() {
                    typeWriter(target, text, i + 1, fnCallback)
                }, 20);
            }
            // text finished, call callback if there is a callback function
            else if (typeof fnCallback == 'function') {
                // call callback after timeout
                setTimeout(fnCallback, 400);
            }
        }

        const interactionButtons = {
            disable: function () {
                document.querySelectorAll(".js-interaction").forEach(function (el) {
                    if (el.tagName === "A") {
                        el.classList.add("disabled");
                    } else {
                        el.disabled = true;
                    }
                });
            },
            enable: function () {
                document.querySelectorAll(".js-interaction").forEach(function (el) {
                    if (el.tagName === "A") {
                        el.classList.remove("disabled");
                    } else {
                        el.disabled = false;
                    }
                });
            }
        }

        const messagesEl = document.getElementById("messages");

        document.querySelectorAll(".js-attack").forEach(function (el) {
            el.addEventListener("submit", function (e) {
                interactionButtons.disable();
                const formData = new FormData(el);
                formData.append(e.submitter.name, e.submitter.value);
                e.preventDefault();
                fetch(new Request(
                    el.action,
                    {
                        method: el.method,
                        body: formData
                    }
                ))
                    .then(response => response.json())
                    .then(responseData => {
                        messagesEl.style.removeProperty("display");
                        messagesEl.querySelector("ul").innerHTML = "";

                        processNextEvent(responseData, function () {
                            interactionButtons.enable();
                        });
                    });
            });
        });
    });
</script>
<style>
    .transition-disabled {
        transition: none !important;
    }

    .progress-bar {
        transition-property: width;
        transition-duration: 2s;
    }

    .slide-down {
        animation: slideDown 2s forwards;
        position: relative;
    }
    .slid-down {
        visibility: hidden;
    }

    @keyframes slideDown {
        from {
            bottom: 0;
        }
        to {
            bottom: -7rem;
        }
    }
</style>

<?php foreach ($errors as $error) : ?>
    <div class="alert alert-danger"><?=$error?></div>
<?php endforeach ?>

<ul class="list-group" style="margin-top: 2rem; margin-bottom: 2rem;">
    <li class="list-group-item" style="text-align: center;">
        <div><strong><?=$trainer->name?></strong></div>
        <div class="js-trainer-team">
            <?php for ($i = 0; $i < $trainer->team->fainted; $i++) : ?>
                <i class="far fa-circle"></i>
            <?php endfor ?>
            <?php for ($i = 0; $i < $trainer->team->active; $i++) : ?>
                <i class="fas fa-circle"></i>
            <?php endfor ?>
        </div>
    </li>
    <li class="list-group-item d-flex flex-row-reverse" data-target-id="<?=$activePokemon->id?>">
        <div class="pokemon-image <?=$activePokemon->isShiny ? "pokemon-image--shiny" : ""?> <?=$activePokemon->hasFainted ? "slid-down" : ""?>">
            <img src="<?=$activePokemon->imageUrl?>">
        </div>
        <div style="text-align: right; flex-grow: 1;">
            <h5><?=$activePokemon->name?></h5>
            <div class="mb-3 d-flex flex-row-reverse">
                <span class="js-types">
                    <span class="badge bg-<?=$activePokemon->primaryType?>" style="text-transform: uppercase;">
                        <?=$activePokemon->primaryType?>
                    </span>
                    <?php if ($activePokemon->secondaryType) : ?>
                        <span class="badge bg-<?=$activePokemon->secondaryType?>" style="text-transform: uppercase;">
                            <?=$activePokemon->secondaryType?>
                        </span>
                    <?php endif ?>
                </span>
                <span class="js-level" style="margin: 0 0.4rem;">
                    Lv <?=$activePokemon->level?>
                </span>
            </div>
            <div>
                <div class="progress justify-content-end" style="height: 2px;">
                    <div class="progress-bar" style="width: <?=$activePokemon->remainingHp / $activePokemon->totalHp * 100?>%;"></div>
                </div>
                <div style="font-size: 0.8rem;"><span class="js-remaining-hp"><?=$activePokemon->remainingHp?></span> / <span class="js-total-hp"><?=$activePokemon->totalHp?></span> HP</div>
            </div>
        </div>
    </li>
    <li class="list-group-item d-flex" data-target-id="<?=$leadPokemon->id?>">
        <div class="pokemon-image <?=$leadPokemon->isShiny ? "pokemon-image--shiny" : ""?> <?=$leadPokemon->hasFainted ? "slid-down" : ""?>">
            <img src="<?=$leadPokemon->imageUrl?>">
        </div>
        <div style="flex-grow: 1">
            <h5><?=$leadPokemon->name?></h5>
            <div class="mb-3">
                <span class="js-types">
                    <span class="badge bg-<?=$leadPokemon->primaryType?>" style="text-transform: uppercase;">
                        <?=$leadPokemon->primaryType?>
                    </span>
                    <?php if ($leadPokemon->secondaryType) : ?>
                        <span class="badge bg-<?=$leadPokemon->secondaryType?>" style="text-transform: uppercase;">
                            <?=$leadPokemon->secondaryType?>
                        </span>
                    <?php endif ?>
                </span>
                <span class="js-level" style="margin: 0 0.4rem;">
                    Lv <?=$leadPokemon->level?>
                </span>
            </div>
            <div>
                <div class="progress" style="height: 2px;">
                    <div class="progress-bar" style="width: <?=$leadPokemon->remainingHp / $leadPokemon->totalHp * 100?>%;"></div>
                </div>
                <div style="font-size: 0.8rem;"><span class="js-remaining-hp"><?=$leadPokemon->remainingHp?></span> / <span class="js-total-hp"><?=$leadPokemon->totalHp?></span> HP</div>
            </div>
        </div>
    </li>
    <li id="messages" class="list-group-item" style="display: none;">
        <ul>
        </ul>
    </li>
    <?php if ($successes) : ?>
        <li class="list-group-item">
            <ul>
                <?php foreach ($successes as $success) : ?>
                    <li><?=$success?></li>
                <?php endforeach ?>
            </ul>
        </li>
    <?php endif ?>
    <li class="list-group-item d-grid gap-2 js-interaction-container" style="text-align: center;">
        <form method="POST" action="/battle/<?=$id?>/finish" class="d-grid <?=$isBattleOver ? "" : "d-none"?>">
            <button type="submit" class="btn btn-outline-dark js-interaction">
                Finish
            </button>
        </form>
        <form method="POST" action="/battle/<?=$id?>/fight" class="d-grid flex-row js-attack <?=$isBattleOver ? "d-none" : ""?>" style="grid-template-columns: 1fr 1fr; column-gap: 0.5rem;">
            <button type="submit" class="btn btn-primary js-interaction" name="attack" value="physical">
                <i class="fas fa-fw fa-paw"></i> Physical
            </button>
            <button type="submit" class="btn btn-primary js-interaction" name="attack" value="special">
                <i class="fas fa-fw fa-wifi"></i> Special
            </button>
        </form>
        <a href="/battle/<?=$id?>/switch" class="btn btn-outline-dark js-interaction <?=$isBattleOver ? "d-none" : ""?>">
            Switch
        </a>
    </li>
</ul>
