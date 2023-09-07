<style>
    .bagSummary img {
        width: 24px;
        filter: grayscale(1);
    }
</style>

<div class="card bagSummary">
    <div class="card-body d-flex justify-content-evenly">
        <div class="d-flex flex-column align-items-center">
            <img src="https://archives.bulbagarden.net/media/upload/9/93/Bag_Pok%C3%A9_Ball_Sprite.png">
            <?=$bagSummary->pokeBalls?>
        </div>
        <div class="d-flex flex-column align-items-center">
            <img src="https://archives.bulbagarden.net/media/upload/8/8d/Bag_Rare_Candy_Sprite.png">
            <?=$bagSummary->rareCandy?>
        </div>
        <div class="d-flex flex-column align-items-center">
            <img src="https://archives.bulbagarden.net/media/upload/c/c4/Bag_Contest_Pass_Sprite.png">
            <?=$bagSummary->challengeTokens?>
        </div>
    </div>
    <a href="/<?=$instanceId?>/bag" class="stretched-link stretched-link--hidden">Go to Bag</a>
</div>

<ul class="list-group" style="margin-top: 2rem;">
    <?php foreach ($party as $pokemon) : ?>
        <li class="list-group-item d-flex">
            <div class="pokemon-image <?=$pokemon->isShiny ? "pokemon-image--shiny" : ""?>" style="width: 3rem; height: 3rem;">
                <img src="<?=$pokemon->imageUrl?>">
            </div>
            <div class="flex-grow-1">
                <h5 class="d-flex justify-content-between align-items-center mb-0">
                    <div>
                        <?=$pokemon->name?>
                        <span class="pokemon-sex">
                            <i class="fas <?=$pokemon->sexIcon?>"></i>
                        </span>
                        <?php if ($pokemon->form) : ?>
                            <span class="badge bg-secondary" style="font-size: 0.8rem;"><?=$pokemon->form?> Form</span>
                        <?php endif ?>
                    </div>
                </h5>
                <p class="mb-0">
                    <span class="pokemon-level mx-0">
                        Lv <?=$pokemon->level?>
                    </span>
                </p>
            </div>
            <a href="/<?=$instanceId?>/party/member/<?=$pokemon->id?>" data-id="<?=$pokemon->id?>" class="stretched-link stretched-link--hidden">Go to Stats</a>
        </li>
    <?php endforeach ?>
</ul>

<div class="d-flex justify-content-between align-items-end mt-4">
    <h2 class="mb-0">Pokémon League</h2>
    <div>
        <span class="badge bg-secondary"><?=$currentPokemonLeague?></span>
    </div>
</div>

<div style="margin-top: 1rem; display: grid; grid-template-columns: repeat(4, 1fr); grid-auto-rows: 1fr; align-items: stretch; grid-column-gap: 0.4rem; grid-row-gap: 0.4rem;">
    <?php foreach ($badges as $badge) : ?>
        <?php if ($badge) : ?>
            <div style="text-align: center; background: #f6f6f6; border-radius: 0.4rem; padding: 0.6rem;">
                <div><img src="<?=$badge->imageUrl?>" style="width: 50px;"></div>
                <div style="line-height: 100%; font-weight: bold; margin-top: 0.4rem;"><small><?=$badge->name?></small></div>
            </div>
        <?php else : ?>
            <div class="d-flex align-items-center justify-content-center" style="text-align: center; min-height: 90px; background: #f6f6f6; border-radius: 0.4rem; color: #ccc;">
                <i class="far fa-fw fa-circle"></i>
            </div>
        <?php endif ?>
    <?php endforeach ?>
</div>
