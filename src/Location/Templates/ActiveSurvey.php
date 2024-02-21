<div class="d-grid gap-4">

    <div class="d-flex justify-content-between align-items-end">
        <div class="d-flex gap-2 align-items-end">
            <h2 class="mb-0"><?=$currentLocation->name?></h2>
            <div>
                <?=$currentLocation->section?>
            </div>
        </div>
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
            <div class="text-center">
                <?php if ($activeSurvey->cumulativeLength->hasDays) : ?>
                    <?=$activeSurvey->cumulativeLength->days?> days
                <?php endif ?>
                <?php if ($activeSurvey->cumulativeLength->hasHours) : ?>
                    <?=$activeSurvey->cumulativeLength->hours?>hr
                <?php endif ?>
                <?php if ($activeSurvey->cumulativeLength->hasMinutes) : ?>
                    <?=$activeSurvey->cumulativeLength->minutes?>m
                <?php endif ?>
                <?php if ($activeSurvey->cumulativeLength->hasSeconds) : ?>
                    <?=$activeSurvey->cumulativeLength->seconds?>s
                <?php endif ?>
            </div>
        </div>
        <div class="card-body">
            <div class="text-center" id="timer" data-started-at="<?=$activeSurvey->startedAt?>">
                <span id="days" style="<?=$activeSurvey->currentLength->hasDays ? "" : "display: none"?>">
                    <span class="value"><?=$activeSurvey->currentLength->days?></span> days
                </span>
                <span id="hours" style="<?=$activeSurvey->currentLength->hasHours ? "" : "display: none"?>">
                    <span class="value"><?=$activeSurvey->currentLength->hours?></span>hr
                </span>
                <span id="minutes" style="<?=$activeSurvey->currentLength->hasMinutes ? "" : "display: none"?>">
                    <span class="value"><?=$activeSurvey->currentLength->minutes?></span>m
                </span>
                <span id="seconds">
                    <span class="value"><?=$activeSurvey->currentLength->seconds?></span>s
                </span>
            </div>
        </div>
    </div>

</div>

<script>
    (function () {
        const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;

        const timerEl = document.getElementById("timer");
        const startedAt = Date.parse(timerEl.dataset.startedAt);

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

            const distance  = Math.floor(new Date().getTime() - startedAt);

            const newDays = Math.floor(distance / day);
            const newHours = Math.floor((distance % day) / hour);
            const newMinutes = Math.floor((distance % hour) / minute);
            const newSeconds = Math.floor((distance % minute) / second);

            if (newDays > 0 && daysEl.style.display === "none") {
                daysEl.style.removeProperty("display")
            }

            if (newHours > 0 && hoursEl.style.display === "none") {
                hoursEl.style.removeProperty("display")
            }

            if (newMinutes > 0 && minutesEl.style.display === "none") {
                minutesEl.style.removeProperty("display")
            }

            daysValueEl.innerText = newDays.toString();
            hoursValueEl.innerText = newHours.toString();
            minutesValueEl.innerText = newMinutes.toString().padStart(2, "0");
            secondsValueEl.innerText = newSeconds.toString().padStart(2, "0");

        }, 0);
    }());
</script>
