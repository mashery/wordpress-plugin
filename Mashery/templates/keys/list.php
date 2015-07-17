<table class="uk-table uk-table-striped uk-table-hover uk-text-nowrap">
    <thead>
        <tr>
            <th>Key</th>
            <th>Created</th>
            <th>Quota (per sec/day)</th>
            <th class="uk-text-center">Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $index => $key): ?>
        <tr>
            <td>
                <a href="<?= add_query_arg( 'key', $key["id"], get_permalink( get_option( 'mashery_key_page' ) ) ) ?>">
                    <?= $key["apikey"] ?>
                </a>
            </td>
            <td><?= date("M jS, Y", strtotime($key["created"])) ?></td>
            <td>
                <?= $key["limits"][0]["ceiling"] ?>
                /
                <?= $key["limits"][1]["ceiling"] ?>
            </td>
            <td class="uk-text-center"><div class="uk-badge uk-badge-<?= ($key["status"] == 'active') ? 'success' : 'danger' ?>"><?= $key["status"] ?></div></td>
            <td class="uk-text-right">
                <button class="uk-button uk-button-mini uk-button-danger" type="button">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a class="uk-button uk-button-small uk-button-success" href="<?= get_permalink( get_option( 'mashery_new_key_page' ) ) ?>">Add a New Key</a>
