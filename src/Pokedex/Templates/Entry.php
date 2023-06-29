<div class="d-grid gap-4">

    <div class="d-flex justify-content-between align-items-end">
        <h2 class="mb-0">Pokédex</h2>
        <a href="/<?=$instanceId?>/pokedex" class="btn btn-sm btn-outline-dark">Back</a>
    </div>

    <ul class="list-group">
        <li class="list-group-item d-flex">
            <?php include __DIR__ . "/PokemonListItem.php" ?>
        </li>
    </ul>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><strong>Encounter Locations</strong></div>
        </div>
        <ul class="list-group list-group-flush">
            <?php if (count($encounterLocations) === 0) : ?>
                <li class="list-group-item">
                    <?=$pokemon->name?> cannot be encountered in the wild
                </li>
            <?php else : ?>
                <?php foreach ($encounterLocations as $encounterLocation) : ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="me-2">
                            <i class="fa-fw <?=$encounterLocation->encounterTypeIcon?> me-1"></i>
                            <?=$encounterLocation->name?>
                            <span class="fw-light"><?=$encounterLocation->section?></span>
                        </div>
                        <div style="text-align: right;">
                            <?php for ($i = 0; $i < $encounterLocation->rarityIcons; $i++) : ?>
                                <i class="fas fa-paw"></i>
                            <?php endfor ?>
                            <span class="badge bg-secondary ms-2"><?=$encounterLocation->region?></span>
                        </div>
                    </li>
                <?php endforeach ?>
            <?php endif ?>
        </ul>
    </div>

</div>
