<div class="d-grid gap-4">

    <div class="d-flex justify-content-between align-items-end">
        <h2 class="mb-0"><?=$currentLocation->name?></h2>
        <a href="/<?=$instanceId?>/map/wild-encounters" class="btn btn-sm btn-outline-dark">
            Back
        </a>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div>
                <i class="fa-fw me-1 <?=$surveyRecord->encounterType->classes?>"></i>
                <strong>Surveyed Wild Pokémon</strong>
            </div>
            <div class="text-center">
                <?php if ($surveyRecord->length->hasDays) : ?>
                    <?=$surveyRecord->length->days?> days
                <?php endif ?>
                <?php if ($surveyRecord->length->hasHours) : ?>
                    <?=$surveyRecord->length->hours?>hr
                <?php endif ?>
                <?php if ($surveyRecord->length->hasMinutes) : ?>
                    <?=$surveyRecord->length->minutes?>m
                <?php endif ?>
                <?php if ($surveyRecord->length->hasSeconds) : ?>
                    <?=$surveyRecord->length->seconds?>s
                <?php endif ?>
            </div>
        </div>
        <?php if ($surveyRecord->hasResults) : ?>
            <ul class="list-group list-group-flush">
                <?php foreach ($surveyRecord->results as $result) : ?>
                    <li class="list-group-item d-flex">
                        <div class="pokemon-image <?=$result->isRegistered ? "" : "pokemon-image--unregistered"?>" style="width: 3rem; height: 3rem;">
                            <img src="<?=$result->imageUrl?>">
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="d-flex justify-content-between align-items-center mb-0">
                                <div>
                                    <?php if ($result->isRegistered) : ?>
                                        <?=$result->name?>
                                    <?php else : ?>
                                        ???
                                    <?php endif ?>
                                    <?php if ($result->form && $result->isRegistered) : ?>
                                        <span class="badge bg-secondary" style="font-size: 0.8rem;"><?=$result->form?> Form</span>
                                    <?php endif ?>
                                </div>
                            </h5>
                            <div class="progress mt-2" style="height: 0.5rem;">
                                <div class="progress-bar" style="width: <?=$result->width?>%;"></div>
                            </div>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php else : ?>
            <div class="card-body text-center">
                Location not surveyed
            </div>
        <?php endif ?>
    </div>

    <?php if ($surveyRecord->isComplete) : ?>
        <button type="button" disabled class="btn btn-primary">Location Fully Surveyed</button>
    <?php else : ?>
        <form class="d-grid" method="POST" action="/<?=$instanceId?>/survey-pokemon/<?=$surveyRecord->encounterType->id?>/start">
            <button type="submit" class="btn btn-primary">
                <?php if ($surveyRecord->hasResults) : ?>
                    Continue Surveying Location
                <?php else : ?>
                    Start Surveying Location
                <?php endif ?>
            </button>
        </form>
    <?php endif ?>

</div>
