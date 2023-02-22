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
                target.querySelector(".progress-bar").style.width = (event.value.remaining / event.value.total * 100) + "%";
                target.querySelector(".js-remaining-hp").innerText = event.value.remaining;
                processNextEvent(responseData, fnCallback);
            } else if (event.type === "fainting") {
                const target = document.querySelector("[data-target-id='" + event.target + "'");
                target.querySelector(".pokemon-image").addEventListener("animationend", function () {
                    location.reload();
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
                }, 50);
            }
            // text finished, call callback if there is a callback function
            else if (typeof fnCallback == 'function') {
                // call callback after timeout
                setTimeout(fnCallback, 400);
            }
        }

        const messagesEl = document.getElementById("messages");

        document.querySelectorAll(".js-attack").forEach(function (el) {
            el.addEventListener("submit", function (e) {
                e.submitter.disabled = true;
                e.preventDefault();
                fetch(new Request(
                    el.action,
                    {
                        method: el.method,
                    }
                ))
                    .then(response => response.json())
                    .then(responseData => {
                        messagesEl.style.removeProperty("display");
                        messagesEl.querySelector("ul").innerHTML = "";

                        processNextEvent(responseData, function () {
                            e.submitter.disabled = false;
                        });
                    });
            });
        });
    });
</script>
<style>
    .progress-bar {
        transition-property: width;
        transition-duration: 2s;
    }

    .slide-down {
        animation: slideDown 2s forwards;
        position: relative;
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
        <div>
            <?php for ($i = 0; $i < $trainer->team->fainted; $i++) : ?>
                <i class="far fa-circle"></i>
            <?php endfor ?>
            <?php for ($i = 0; $i < $trainer->team->active; $i++) : ?>
                <i class="fas fa-circle"></i>
            <?php endfor ?>
        </div>
    </li>
    <li class="list-group-item d-flex flex-row-reverse" data-target-id="<?=$activePokemon->id?>">
        <div class="pokemon-image <?=$activePokemon->isShiny ? "pokemon-image--shiny" : ""?>">
            <img src="<?=$activePokemon->imageUrl?>">
        </div>
        <div style="text-align: right; flex-grow: 1;">
            <h5><?=$activePokemon->name?></h5>
            <div class="mb-3 d-flex flex-row-reverse">
                <span>
                    <span class="badge bg-<?=$activePokemon->primaryType?>" style="text-transform: uppercase;">
                        <?=$activePokemon->primaryType?>
                    </span>
                    <?php if ($activePokemon->secondaryType) : ?>
                        <span class="badge bg-<?=$activePokemon->secondaryType?>" style="text-transform: uppercase;">
                            <?=$activePokemon->secondaryType?>
                        </span>
                    <?php endif ?>
                </span>
                <span style="margin: 0 0.4rem;">
                    Level <?=$activePokemon->level?>
                </span>
            </div>
            <div>
                <div class="progress justify-content-end" style="height: 2px;">
                    <div class="progress-bar" style="width: <?=$activePokemon->remainingHp / $activePokemon->totalHp * 100?>%;"></div>
                </div>
                <div style="font-size: 0.8rem;"><span class="js-remaining-hp"><?=$activePokemon->remainingHp?></span> / <?=$activePokemon->totalHp?> HP</div>
            </div>
        </div>
    </li>
    <li class="list-group-item d-flex" data-target-id="<?=$leadPokemon->id?>">
        <div class="pokemon-image <?=$leadPokemon->isShiny ? "pokemon-image--shiny" : ""?>">
            <img src="<?=$leadPokemon->imageUrl?>">
        </div>
        <div style="flex-grow: 1">
            <h5><?=$leadPokemon->name?></h5>
            <div class="mb-3">
                <span>
                    <span class="badge bg-<?=$leadPokemon->primaryType?>" style="text-transform: uppercase;">
                        <?=$leadPokemon->primaryType?>
                    </span>
                    <?php if ($leadPokemon->secondaryType) : ?>
                        <span class="badge bg-<?=$leadPokemon->secondaryType?>" style="text-transform: uppercase;">
                            <?=$leadPokemon->secondaryType?>
                        </span>
                    <?php endif ?>
                </span>
                <span style="margin: 0 0.4rem;">
                    Level <?=$leadPokemon->level?>
                </span>
            </div>
            <div>
                <div class="progress" style="height: 2px;">
                    <div class="progress-bar" style="width: <?=$leadPokemon->remainingHp / $leadPokemon->totalHp * 100?>%;"></div>
                </div>
                <div style="font-size: 0.8rem;"><span class="js-remaining-hp"><?=$leadPokemon->remainingHp?></span> / <?=$leadPokemon->totalHp?> HP</div>
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
    <li class="list-group-item d-grid gap-2" style="text-align: center;">
        <?php if ($isBattleOver) : ?>
            <form method="POST" action="/battle/<?=$id?>/finish" class="d-grid">
                <button type="submit" class="btn btn-outline-dark">
                    Finish
                </button>
            </form>
        <?php else : ?>
            <form method="POST" action="/battle/<?=$id?>/fight" class="d-grid js-attack">
                <button type="submit" class="btn btn-primary">
                    Fight
                </button>
            </form>
            <a href="/battle/<?=$id?>/switch" class="btn btn-outline-dark">
                Switch
            </a>
        <?php endif ?>
    </li>
</ul>
