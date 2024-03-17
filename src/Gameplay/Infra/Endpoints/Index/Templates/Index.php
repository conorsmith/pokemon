<style>
    .bagSummary img {
        width: 24px;
    }

    .bagSummary {
        font-size: 0.8rem;
    }
</style>

<div class="d-flex gap-3 justify-content-between">
    <div>
        <a href="/<?=$instanceId?>/status">
            <img src="/assets/FRLG_Red_Intro.png">
        </a>
    </div>
    <div class="card flex-grow-1 bagSummary">
        <div class="card-body d-flex justify-content-between px-4">
            <div class="d-flex gap-1 flex-column align-items-center">
                <img src="/assets/items/Bag_Pok%C3%A9_Ball_Sprite.png">
                <?=$bagSummary->pokeBalls?>
            </div>
            <div class="d-flex gap-1 flex-column align-items-center">
                <img src="/assets/items/Bag_Rare_Candy_Sprite.png">
                <?=$bagSummary->rareCandy?>
            </div>
            <div class="d-flex gap-1 flex-column align-items-center">
                <img src="/assets/items/Bag_Contest_Pass_Sprite.png">
                <?=$bagSummary->challengeTokens?>
            </div>
            <div class="d-flex gap-1 flex-column align-items-center">
                <img src="/assets/items/Bag_Oval_Charm_Sprite.png">
                <?=$bagSummary->ovalCharms?>
            </div>
        </div>
        <a href="/<?=$instanceId?>/bag" class="stretched-link stretched-link--hidden">Go to Bag</a>
    </div>
</div>

<div class="card mt-1" style="font-size: 0.875rem;">
    <div class="card-body d-flex gap-2 align-items-center py-2">
        <div>
            <img src="/assets/items/Bag_Town_Map_Sprite.png">
        </div>
        <div class="flex-grow-1">
            <div><?=$location->name?></div>
            <div style="font-weight: lighter;"><?=$location->section?></div>
        </div>
        <div><?=$location->region?></div>
    </div>
    <a href="/<?=$instanceId?>/map" class="stretched-link stretched-link--hidden">Go to Map</a>
</div>

<ul class="list-group mt-1">
    <?php foreach ($party as $slot) : ?>
        <?php if ($slot->hasMember) : ?>
            <li class="list-group-item d-flex">
                <div class="pokemon-image <?=$slot->member->isShiny ? "pokemon-image--shiny" : ""?>" style="width: 3rem; height: 3rem;">
                    <img src="<?=$slot->member->imageUrl?>">
                </div>
                <div class="flex-grow-1">
                    <h5 class="d-flex justify-content-between align-items-center mb-0">
                        <div>
                            <?=$slot->member->name?>
                            <span class="pokemon-sex">
                                <i class="fas <?=$slot->member->sexIcon?>"></i>
                            </span>
                            <?php if ($slot->member->form) : ?>
                                <span class="badge bg-secondary" style="font-size: 0.8rem;"><?=$slot->member->form?> Form</span>
                            <?php endif ?>
                        </div>
                    </h5>
                    <p class="mb-0">
                        <span class="pokemon-level mx-0">
                            Lv <?=$slot->member->level?>
                        </span>
                    </p>
                </div>
                <a href="/<?=$instanceId?>/party/member/<?=$slot->member->id?>" data-id="<?=$slot->member->id?>" class="stretched-link stretched-link--hidden">Go to Stats</a>
            </li>
        <?php else : ?>
            <li class="list-group-item d-flex" style="height: 64.8px;">
            </li>
        <?php endif ?>
    <?php endforeach ?>
</ul>
