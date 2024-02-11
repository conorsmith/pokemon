<div class="d-grid gap-4">


    <h2>Notifications</h2>

    <table class="table align-middle">
        <?php foreach ($archivedNotifications as $notification) : ?>
            <tr>
                <td style="font-size: 0.8rem; white-space: nowrap;"><?=$notification->date?></td>
                <td style="font-size: 0.8rem; white-space: nowrap;"><?=$notification->time?></td>
                <td><?=$notification->message?></td>
            </tr>
        <?php endforeach ?>
    </table>

</div>
