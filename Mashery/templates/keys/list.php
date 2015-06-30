<a class="uk-button" href="<?= get_permalink( get_option( 'mashery_new_key_page' ) ) ?>">Add New Key</a>

<table class="uk-table uk-table-hover">
    <thead>
        <tr>
            <th>Status</th>
            <th>Key</th>
            <th>Created</th>
            <th>Quota (per sec/day)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $index => $key): ?>
        <tr>
            <td><?= $key["status"] ?></td>
            <td>
                <a href="<?= add_query_arg( 'key', $key["id"], get_permalink( get_option( 'mashery_key_page' ) ) ) ?>">
                    <?= substr($key["apikey"], 0, 6) . "..." ?>
                </a>
            </td>
            <td><?= $key["created"] ?></td>
            <td>
                <?= $key["limits"][0]["ceiling"] ?>
                /
                <?= $key["limits"][1]["ceiling"] ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
