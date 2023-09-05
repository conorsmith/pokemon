<div class="d-grid gap-4">

    <style>
        .team-stats {
            font-size: 0.75rem;
        }

        .team-stats .positive {
            color: #4AA14D;
        }

        .team-stats .negative {
            color: #FF1111;
        }
    </style>

    <div class="btn-group">
        <a href="?<?=$buildQuery('show', "effective-stats")?>" class="btn btn-sm btn-outline-dark <?=$query->show === "effective-stats" ? "active" : ""?>">Effective Stats</a>
        <a href="?<?=$buildQuery('show', "base-stats")?>" class="btn btn-sm btn-outline-dark <?=$query->show === "base-stats" ? "active" : ""?>">Base Stats</a>
        <a href="?<?=$buildQuery('show', "genetic-stats")?>" class="btn btn-sm btn-outline-dark <?=$query->show === "genetic-stats" ? "active" : ""?>">Genetic Stats</a>
    </div>

    <div class="btn-group">
        <a href="?<?=$buildQuery('sort', "number")?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "number" ? "active" : ""?>">#</a>
        <a href="?<?=$buildQuery('sort', "time")?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "time" ? "active" : ""?>"><i class="fa-fw fas fa-clock"></i></a>
        <a href="?<?=$buildQuery('sort', "lv")?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "lv" ? "active" : ""?>"><i class="fa-fw fas fa-arrow-alt-circle-up"></i></a>
        <a href="?<?=$buildQuery('sort', "pa")?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "pa" ? "active" : ""?>"><i class="fa-fw fas fa-paw"></i></a>
        <a href="?<?=$buildQuery('sort', "sa")?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "sa" ? "active" : ""?>"><i class="fa-fw fas fa-wifi"></i></a>
        <a href="?<?=$buildQuery('sort', "pd")?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "pd" ? "active" : ""?>"><i class="fa-fw fas fa-shield-alt"></i></a>
        <a href="?<?=$buildQuery('sort', "sd")?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "sd" ? "active" : ""?>"><i class="fa-fw fas fa-expand"></i></a>
        <a href="?<?=$buildQuery('sort', "sp")?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "sp" ? "active" : ""?>"><i class="fa-fw fas fa-wind"></i></a>
        <a href="?<?=$buildQuery('sort', "hp")?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "hp" ? "active" : ""?>"><i class="fa-fw fas fa-heartbeat"></i></a>
    </div>

    <div>
        <?php foreach ($typeFilters as $typeFilter) : ?>
            <a href="?<?=$buildQuery('filter[type]', $typeFilter->id)?>"><span class="badge <?=$typeFilter->isActive ? "text-bg-dark" : "bg-{$typeFilter->name}"?>" style="text-transform: uppercase;"><?=$typeFilter->name?></span></a>
        <?php endforeach ?>
        <a href="?<?=$clearFilter('type')?>"><span class="badge text-bg-light">Clear</span></a>
    </div>

    <table class="table table-sm team-stats">
        <tr>
            <td></td>
            <td></td>
            <td class="stat"><i class="fa-fw fas fa-arrow-alt-circle-up"></i></td>
            <td class="stat"><i class="fa-fw fas fa-paw"></i></td>
            <td class="stat"><i class="fa-fw fas fa-wifi"></i></td>
            <td class="stat"><i class="fa-fw fas fa-shield-alt"></i></td>
            <td class="stat"><i class="fa-fw fas fa-expand"></i></td>
            <td class="stat"><i class="fa-fw fas fa-wind"></i></td>
            <td class="stat"><i class="fa-fw fas fa-heartbeat"></i></td>
        </tr>
        <?php foreach ($allPokemon as $pokemon) : ?>
            <tr>
                <td><a href="?<?=$buildQuery('filter[family]', $pokemon->pokedexNumber)?>"><?=$pokemon->name?></a></td>
                <td class="stat"><i class="fa-fw fas <?=$pokemon->sex?>"></i></td>
                <td class="stat"><?=$pokemon->level?></td>
                <?php if ($query->show === "effective-stats") : ?>
                    <td class="stat"><?=$pokemon->effectiveStats->physicalAttack?></td>
                    <td class="stat"><?=$pokemon->effectiveStats->specialAttack?></td>
                    <td class="stat"><?=$pokemon->effectiveStats->physicalDefence?></td>
                    <td class="stat"><?=$pokemon->effectiveStats->specialDefence?></td>
                    <td class="stat"><?=$pokemon->effectiveStats->speed?></td>
                    <td class="stat"><?=$pokemon->effectiveStats->hp?></td>
                <?php elseif ($query->show === "base-stats") : ?>
                    <td class="stat"><?=$pokemon->baseStats->physicalAttack?></td>
                    <td class="stat"><?=$pokemon->baseStats->specialAttack?></td>
                    <td class="stat"><?=$pokemon->baseStats->physicalDefence?></td>
                    <td class="stat"><?=$pokemon->baseStats->specialDefence?></td>
                    <td class="stat"><?=$pokemon->baseStats->speed?></td>
                    <td class="stat"><?=$pokemon->baseStats->hp?></td>
                <?php elseif ($query->show === "genetic-stats") : ?>
                    <td class="stat <?=$pokemon->geneticStats->physicalAttack->class?>"><?=$pokemon->geneticStats->physicalAttack->value?></td>
                    <td class="stat <?=$pokemon->geneticStats->specialAttack->class?>"><?=$pokemon->geneticStats->specialAttack->value?></td>
                    <td class="stat <?=$pokemon->geneticStats->physicalDefence->class?>"><?=$pokemon->geneticStats->physicalDefence->value?></td>
                    <td class="stat <?=$pokemon->geneticStats->specialDefence->class?>"><?=$pokemon->geneticStats->specialDefence->value?></td>
                    <td class="stat <?=$pokemon->geneticStats->speed->class?>"><?=$pokemon->geneticStats->speed->value?></td>
                    <td class="stat <?=$pokemon->geneticStats->hp->class?>"><?=$pokemon->geneticStats->hp->value?></td>
                <?php endif ?>
            </tr>
        <?php endforeach ?>
        <?php if (array_key_exists('family', $query->filter)) : ?>
            <tr>
                <td colspan="9">
                    <a href="?<?=$clearFilter('family')?>">Clear filter</a>
                </td>
            </tr>
        <?php endif ?>
    </table>
</div>
