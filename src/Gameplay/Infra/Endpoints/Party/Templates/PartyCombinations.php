<?php include __DIR__ . "/BottomNav.php" ?>

<div class="d-grid gap-4">

    <div class="d-flex justify-content-between align-items-end">
        <h2 class="mb-0">Strongest Pokémon</h2>
        <div>
            <strong><?=$availableTypes?></strong> types
        </div>
    </div>

    <div class="btn-group">
        <a href="?sort=hp" class="btn btn-sm btn-outline-dark <?=$query->sort === "hp" ? "active" : ""?>">HP</a>
        <a href="?sort=pa" class="btn btn-sm btn-outline-dark <?=$query->sort === "pa" ? "active" : ""?>">PA</a>
        <a href="?sort=sa" class="btn btn-sm btn-outline-dark <?=$query->sort === "sa" ? "active" : ""?>">SA</a>
        <a href="?sort=pd" class="btn btn-sm btn-outline-dark <?=$query->sort === "pd" ? "active" : ""?>">PD</a>
        <a href="?sort=sd" class="btn btn-sm btn-outline-dark <?=$query->sort === "sd" ? "active" : ""?>">SD</a>
        <a href="?sort=sp" class="btn btn-sm btn-outline-dark <?=$query->sort === "sp" ? "active" : ""?>">SP</a>
        <a href="?sort=total" class="btn btn-sm btn-outline-dark <?=$query->sort === "total" ? "active" : ""?>">Σ</a>
    </div>

    <ul class="list-group">
        <li class="list-group-item d-grid" style="background-color: #fafafa; grid-template-columns: repeat(7, minmax(0, 1fr));">
            <div class="stat">HP</div>
            <div class="stat">PA</div>
            <div class="stat">SA</div>
            <div class="stat">PD</div>
            <div class="stat">SD</div>
            <div class="stat">SP</div>
            <div class="stat">Σ</div>
        </li>
        <?php foreach ($options as $pokemon) : ?>
            <?php include __DIR__ . "/PokemonStatListItem.php" ?>
        <?php endforeach ?>
    </ul>

</div>
