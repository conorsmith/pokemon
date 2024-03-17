<div class="d-grid gap-4">

    <h2>Bag</h2>

    <ul class="list-group">

        <?php foreach ($items as $item) : ?>
            <?php include __DIR__ . "/../../../../../SharedKernel/Templates/BagItem.php" ?>
        <?php endforeach ?>

    </ul>

    <?php if (count($evolutionItems) > 0) : ?>

        <ul class="list-group">

            <li class="list-group-item d-flex justify-content-between" style="background: #fafafa;">
                <strong>Evolution Items</strong>
            </li>

            <?php foreach ($evolutionItems as $item) : ?>
                <?php include __DIR__ . "/../../../../../SharedKernel/Templates/BagItem.php" ?>
            <?php endforeach ?>

        </ul>

    <?php endif ?>

    <?php if (count($statsItems) > 0) : ?>

        <ul class="list-group">

            <li class="list-group-item d-flex justify-content-between" style="background: #fafafa;">
                <strong>Stat Boosting Items</strong>
            </li>

            <?php foreach ($statsItems as $item) : ?>
                <?php include __DIR__ . "/../../../../../SharedKernel/Templates/BagItem.php" ?>
            <?php endforeach ?>

        </ul>

    <?php endif ?>

    <?php if (count($heldItems) > 0) : ?>

        <ul class="list-group">

            <li class="list-group-item d-flex justify-content-between" style="background: #fafafa;">
                <strong>Held Items</strong>
            </li>

            <?php foreach ($heldItems as $item) : ?>
                <?php include __DIR__ . "/../../../../../SharedKernel/Templates/BagItem.php" ?>
            <?php endforeach ?>

        </ul>

    <?php endif ?>

    <?php if (count($fossilItems) > 0) : ?>

        <ul class="list-group">

            <li class="list-group-item d-flex justify-content-between" style="background: #fafafa;">
                <strong>Fossils</strong>
            </li>

            <?php foreach ($fossilItems as $item) : ?>
                <?php include __DIR__ . "/../../../../../SharedKernel/Templates/BagItem.php" ?>
            <?php endforeach ?>

        </ul>

    <?php endif ?>

</div>
