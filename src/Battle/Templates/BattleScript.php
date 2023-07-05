<script>
    const types = [
        "normal",
        "fighting",
        "flying",
        "poison",
        "ground",
        "rock",
        "bug",
        "ghost",
        "steel",
        "fire",
        "water",
        "grass",
        "electric",
        "psychic",
        "ice",
        "dragon",
        "dark",
        "fairy"
    ];

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

            } else if (event.type === "shake") {
                const messageEl = document.createElement("li");
                messagesEl.querySelector("ul").appendChild(messageEl);
                typeWriter(messagesEl.querySelector("ul").lastChild, "...", 0, function () {
                    processNextEvent(responseData, fnCallback);
                });

            } else if (event.type === "caught") {
                const messageEl = document.createElement("li");
                messagesEl.querySelector("ul").appendChild(messageEl);
                typeWriter(messagesEl.querySelector("ul").lastChild, event.value, 0, function () {

                    processNextEvent(responseData, function () {

                        document.querySelectorAll(".js-interaction-container > *").forEach(function (el) {
                            if (el.classList.contains("d-none")) {
                                el.classList.remove("d-none");
                            } else {
                                el.classList.add("d-none");
                            }
                        });

                        fnCallback();
                    });
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
                        if (firstFilledIcon !== null) {
                            firstFilledIcon.classList.add("far");
                            firstFilledIcon.classList.remove("fas");
                        }
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
                    target.querySelector(".js-name").innerText = event.next.name;

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

                    let sexIcon;
                    if (event.next.sex === "F") {
                        sexIcon = "venus";
                    } else if (event.next.sex === "M") {
                        sexIcon = "mars";
                    } else if (event.next.sex === "U") {
                        sexIcon = "genderless";
                    }

                    target.querySelector(".js-sex").innerHTML = `<i class="fas fa-${sexIcon}"></i>`;

                    target.querySelector(".js-level").innerHTML = "Lv " + event.next.level;

                    target.querySelector(".progress-bar").classList.add("transition-disabled");
                    target.querySelector(".progress-bar").style.width = "100%";

                    target.querySelector(".js-remaining-hp").innerText = event.next.remainingHp;
                    target.querySelector(".js-total-hp").innerText = event.next.totalHp;

                    if (event.isPlayerPokemon) {
                        const physicalPrimaryBtnEl = document.querySelector(".js-interaction[value='physical-primary']");
                        const specialPrimaryBtnEl = document.querySelector(".js-interaction[value='special-primary']");
                        const physicalSecondaryBtnEl = document.querySelector(".js-interaction[value='physical-secondary']");
                        const specialSecondaryBtnEl = document.querySelector(".js-interaction[value='special-secondary']");

                        physicalPrimaryBtnEl.querySelector(".badge").innerText = event.next.physicalAttack;
                        physicalPrimaryBtnEl.classList.remove(...types.map((type) => "btn-" + type));
                        physicalPrimaryBtnEl.classList.add("btn-" + event.next.primaryType);

                        specialPrimaryBtnEl.querySelector(".badge").innerText = event.next.specialAttack;
                        specialPrimaryBtnEl.classList.remove(...types.map((type) => "btn-" + type));
                        specialPrimaryBtnEl.classList.add("btn-" + event.next.primaryType);

                        if (event.next.secondaryType) {
                            physicalSecondaryBtnEl.parentNode.classList.remove("d-none");

                            physicalSecondaryBtnEl.querySelector(".badge").innerText = event.next.physicalAttack;
                            physicalSecondaryBtnEl.classList.remove(...types.map((type) => "btn-" + type));
                            physicalSecondaryBtnEl.classList.add("btn-" + event.next.secondaryType);

                            specialSecondaryBtnEl.querySelector(".badge").innerText = event.next.specialAttack;
                            specialSecondaryBtnEl.classList.remove(...types.map((type) => "btn-" + type));
                            specialSecondaryBtnEl.classList.add("btn-" + event.next.secondaryType);
                        } else {
                            physicalSecondaryBtnEl.parentNode.classList.add("d-none");
                        }
                    }

                    processNextEvent(responseData, fnCallback);
                }, {
                    once: true
                });

                target.querySelector(".pokemon-image").classList.add("slide-down");

            } else if (event.type === "strengthIndicatorProgresses") {

                document.querySelector(".js-strength-indicator[data-phase='" + (event.progress - 1) + "']")
                    .classList.replace("d-flex", "d-none");

                document.querySelector("." +
                    "js-strength-indicator[data-phase='" + event.progress + "']")
                    .classList.replace("d-none", "d-flex");

                const messageEl = document.createElement("li");
                messagesEl.querySelector("ul").appendChild(messageEl);
                typeWriter(messagesEl.querySelector("ul").lastChild, event.value, 0, function () {
                    processNextEvent(responseData, fnCallback);
                });

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

        document.querySelectorAll(".js-catch").forEach(function (el) {
            el.addEventListener("submit", function (e) {
                const confirmationModal = new bootstrap.Modal(document.querySelector('.js-pokeball-confirmation'), {});

                confirmationModal.show();
                let formSubmitterName = e.submitter.name;
                let formSubmitterValue = e.submitter.value;
                e.preventDefault();

                confirmationModal._element.querySelector(".js-pokeball-confirmation-cancel").addEventListener("click", function (e) {
                    confirmationModal.hide();

                    const oldModalEl = confirmationModal._element;
                    const newModalEl = oldModalEl.cloneNode(true);
                    oldModalEl.parentNode.replaceChild(newModalEl, oldModalEl);

                    e.preventDefault();
                });

                confirmationModal._element.querySelector(".js-pokeball-confirmation-confirm").addEventListener("click", function (e) {
                    confirmationModal.hide();
                    interactionButtons.disable();
                    const formData = new FormData(el);
                    formData.append(formSubmitterName, formSubmitterValue);
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

                            const counterEl = el.querySelector("span");
                            let count = parseInt(counterEl.innerText, 10);
                            if (count > 0) {
                                count--;
                            }
                            counterEl.innerText = count;

                            const oldModalEl = confirmationModal._element;
                            const newModalEl = oldModalEl.cloneNode(true);
                            oldModalEl.parentNode.replaceChild(newModalEl, oldModalEl);

                            messagesEl.style.removeProperty("display");
                            messagesEl.querySelector("ul").innerHTML = "";

                            processNextEvent(responseData, function () {
                                interactionButtons.enable();
                            });
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
