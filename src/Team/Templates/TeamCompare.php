<div class="d-grid gap-4">

    <style>
        .team-stats {
            font-size: 0.8rem;
        }

        .team-stats .positive {
            color: #4AA14D;
        }

        .team-stats .negative {
            color: #FF1111;
        }
    </style>

    <div class="btn-group">
        <a href="?show=effective-stats&sort=<?=$query->sort?>&filter=<?=$query->filter?>" class="btn btn-sm btn-outline-dark <?=$query->show === "effective-stats" ? "active" : ""?>">Effective Stats</a>
        <a href="?show=base-stats&sort=<?=$query->sort?>&filter=<?=$query->filter?>" class="btn btn-sm btn-outline-dark <?=$query->show === "base-stats" ? "active" : ""?>">Base Stats</a>
        <a href="?show=genetic-stats&sort=<?=$query->sort?>&filter=<?=$query->filter?>" class="btn btn-sm btn-outline-dark <?=$query->show === "genetic-stats" ? "active" : ""?>">Genetic Stats</a>
    </div>

    <div class="btn-group">
        <a href="?show=<?=$query->show?>&sort=number&filter=<?=$query->filter?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "number" ? "active" : ""?>">#</a>
        <a href="?show=<?=$query->show?>&sort=lv&filter=<?=$query->filter?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "lv" ? "active" : ""?>">LV</a>
        <a href="?show=<?=$query->show?>&sort=hp&filter=<?=$query->filter?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "hp" ? "active" : ""?>">HP</a>
        <a href="?show=<?=$query->show?>&sort=pa&filter=<?=$query->filter?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "pa" ? "active" : ""?>">PA</a>
        <a href="?show=<?=$query->show?>&sort=sa&filter=<?=$query->filter?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "sa" ? "active" : ""?>">SA</a>
        <a href="?show=<?=$query->show?>&sort=pd&filter=<?=$query->filter?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "pd" ? "active" : ""?>">PD</a>
        <a href="?show=<?=$query->show?>&sort=sd&filter=<?=$query->filter?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "sd" ? "active" : ""?>">SD</a>
        <a href="?show=<?=$query->show?>&sort=sp&filter=<?=$query->filter?>" class="btn btn-sm btn-outline-dark <?=$query->sort === "sp" ? "active" : ""?>">SP</a>
    </div>

    <div>
        <?php foreach ($typeFilters as $typeFilter) : ?>
            <a href="?show=<?=$query->show?>&sort=<?=$query->sort?>&filter=<?=$typeFilter->id?>"><span class="badge <?=$typeFilter->isActive ? "text-bg-dark" : "bg-{$typeFilter->name}"?>" style="text-transform: uppercase;"><?=$typeFilter->name?></span></a>
        <?php endforeach ?>
        <a href="?show=<?=$query->show?>&sort=<?=$query->sort?>"><span class="badge text-bg-light">Clear</span></a>
    </div>

    <table class="table table-sm team-stats">
        <tr>
            <td></td>
            <td class="stat">LV</td>
            <td class="stat">HP</td>
            <td class="stat">PA</td>
            <td class="stat">SA</td>
            <td class="stat">PD</td>
            <td class="stat">SD</td>
            <td class="stat">SP</td>
        </tr>
        <?php foreach ($allPokemon as $pokemon) : ?>
            <tr>
                <td><a href="/team/member/<?=$pokemon->id?>"><?=$pokemon->name?></a></td>
                <td class="stat"><?=$pokemon->level?></td>
                <?php if ($query->show === "effective-stats") : ?>
                    <td class="stat"><?=$pokemon->effectiveStats->hp?></td>
                    <td class="stat"><?=$pokemon->effectiveStats->physicalAttack?></td>
                    <td class="stat"><?=$pokemon->effectiveStats->specialAttack?></td>
                    <td class="stat"><?=$pokemon->effectiveStats->physicalDefence?></td>
                    <td class="stat"><?=$pokemon->effectiveStats->specialDefence?></td>
                    <td class="stat"><?=$pokemon->effectiveStats->speed?></td>
                <?php elseif ($query->show === "base-stats") : ?>
                    <td class="stat"><?=$pokemon->baseStats->hp?></td>
                    <td class="stat"><?=$pokemon->baseStats->physicalAttack?></td>
                    <td class="stat"><?=$pokemon->baseStats->specialAttack?></td>
                    <td class="stat"><?=$pokemon->baseStats->physicalDefence?></td>
                    <td class="stat"><?=$pokemon->baseStats->specialDefence?></td>
                    <td class="stat"><?=$pokemon->baseStats->speed?></td>
                <?php elseif ($query->show === "genetic-stats") : ?>
                    <td class="stat <?=$pokemon->geneticStats->hp->class?>"><?=$pokemon->geneticStats->hp->value?></td>
                    <td class="stat <?=$pokemon->geneticStats->physicalAttack->class?>"><?=$pokemon->geneticStats->physicalAttack->value?></td>
                    <td class="stat <?=$pokemon->geneticStats->specialAttack->class?>"><?=$pokemon->geneticStats->specialAttack->value?></td>
                    <td class="stat <?=$pokemon->geneticStats->physicalDefence->class?>"><?=$pokemon->geneticStats->physicalDefence->value?></td>
                    <td class="stat <?=$pokemon->geneticStats->specialDefence->class?>"><?=$pokemon->geneticStats->specialDefence->value?></td>
                    <td class="stat <?=$pokemon->geneticStats->speed->class?>"><?=$pokemon->geneticStats->speed->value?></td>
                <?php endif ?>
            </tr>
        <?php endforeach ?>
    </table>
</div>
