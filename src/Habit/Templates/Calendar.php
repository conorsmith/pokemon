<style>
    td.empty-cell {
        background-color: #fafafa;
    }

    .date-cell {
        position: relative;
        text-align: center;
        width: calc(100% / 7);
    }

    .date-cell.date-cell--is-highlighted {
        background-color: var(--bs-primary);
        color: #fff;
    }

    .date-cell.date-cell--is-future {
        background-color: #fafafa;
        color: #aaa;
    }

    .corner-date {
        position: absolute;
        top: 0;
        left: 0.2rem;
        font-size: 0.8rem;
    }
</style>

<?php foreach ($calendar->months as $month) : ?>

    <div><strong><?=$month->title?></strong></div>

    <table class="table table-bordered">
        <?php foreach ($month->weeks as $week) : ?>
            <tr>
                <?php foreach ($week->squares as $square) : ?>
                    <?php if ($square->isEmpty) : ?>
                        <td class="empty-cell"></td>
                    <?php else : ?>
                        <td class="date-cell
                                   <?=$square->isHighlighted ? "date-cell--is-highlighted" : ""?>
                                   <?=$square->isFuture ? "date-cell--is-future" : ""?>
                                  ">
                            <?php if ($square->contents->isDateOnly) : ?>
                                <?=$square->contents->date?>
                            <?php else : ?>
                                <div class="corner-date">
                                    <?=$square->contents->date?>
                                </div>
                                <?=$square->contents->additionalContent?>
                            <?php endif ?>
                        </td>
                    <?php endif ?>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
    </table>

<?php endforeach ?>

