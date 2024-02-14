<div class="d-grid gap-4">

    <div class="d-flex justify-content-between align-items-end">
        <h2 class="mb-0"><?=$currentLocation->name?></h2>
        <form method="POST" action="/<?=$instanceId?>/survey-pokemon/<?=$activeSurvey->encounterType->id?>/finish">
            <button type="submit" class="btn btn-sm btn-outline-dark">Finish Surveying</button>
        </form>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div>
                <i class="fa-fw me-1 <?=$activeSurvey->encounterType->classes?>"></i>
                <strong>Surveying Wild Pokémon</strong>
            </div>
        </div>
        <div class="card-body">
            <div class="text-center">
                <span id="days" style="<?=$activeSurvey->length->hasDays ? "" : "display: none"?>">
                    <span class="value"><?=$activeSurvey->length->days?></span> days
                </span>
                <span id="hours" style="<?=$activeSurvey->length->hasHours ? "" : "display: none"?>">
                    <span class="value"><?=$activeSurvey->length->hours?></span>hr
                </span>
                <span id="minutes" style="<?=$activeSurvey->length->hasMinutes ? "" : "display: none"?>">
                    <span class="value"><?=$activeSurvey->length->minutes?></span>m
                </span>
                <span id="seconds">
                    <span class="value"><?=$activeSurvey->length->seconds?></span>s
                </span>
            </div>
        </div>
    </div>

</div>

<script>
    (function () {
        const secondsValueEl = document.querySelector("#seconds .value");
        const minutesEl = document.getElementById("minutes");
        const minutesValueEl = document.querySelector("#minutes .value");
        const hoursEl = document.getElementById("hours");
        const hoursValueEl = document.querySelector("#hours .value");
        const daysEl = document.getElementById("days");
        const daysValueEl = document.querySelector("#days .value");

        let then = Math.floor(new Date().getTime() / 1000);

        const interval = setInterval(function() {

            const now = Math.floor(new Date().getTime() / 1000);

            if (then === now) {
                return;
            }

            then = now;

            const seconds = parseInt(secondsValueEl.innerText, 10);

            if (seconds < 59) {
                secondsValueEl.innerText = (seconds + 1).toString().padStart(2, "0");
                return;
            }

            secondsValueEl.innerText = "00";

            const minutes = parseInt(minutesValueEl.innerText, 10);

            if (minutes === 0) {
                minutesEl.style.removeProperty("display");
            }

            if (minutes < 59) {
                minutesValueEl.innerText = (minutes + 1).toString().padStart(2, "0");
                return;
            }

            minutesValueEl.innerText = "00";

            const hours = parseInt(hoursValueEl.innerText, 10);

            if (hours === 0) {
                hoursEl.style.removeProperty("display");
            }

            if (hours < 23) {
                hoursValueEl.innerText = (hours + 1).toString();
                return;
            }

            hoursValueEl.innerText = "0";

            const days = parseInt(daysValueEl.innerText, 10);

            if (days === 0) {
                daysEl.style.removeProperty("display");
            }

            daysValueEl.innerText = (days + 1).toString();

            }, 0);
    }());
</script>
