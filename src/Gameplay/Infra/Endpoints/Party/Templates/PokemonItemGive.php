<div class="d-grid gap-4">

    <div class="d-flex justify-content-between align-items-end">
        <h2 class="mb-0">Bag</h2>
        <a href="/<?=$instanceId?>/party/member/<?=$pokemon->id?>" class="btn btn-sm btn-outline-dark">Cancel</a>
    </div>

    <div class="card" style="margin-top: 2rem; padding: 1rem;">
        <div style="text-align: center;">
            Choose item to give to
        </div>
        <div style="text-align: center;">
            <strong><?=$pokemon->name?></strong>
        </div>
    </div>

    <ul class="list-group">

        <?php foreach ($items as $item) : ?>
            <?php include __DIR__ . "/../../../../../SharedKernel/Templates/BagItem.php" ?>
        <?php endforeach ?>

    </ul>

</div>
