<table class="uk-table uk-text-nowrap">
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
        <tr>
            <td>
                <?= $data["apikey"] ?>
            </td>
            <td><?= date("M jS, Y", strtotime($data["created"])) ?></td>
            <td>
                <?= $data["limits"][0]["ceiling"] ?>
                /
                <?= $data["limits"][1]["ceiling"] ?>
            </td>
            <td class="uk-text-center"><div class="uk-badge uk-badge-<?= ($data["status"] == 'active') ? 'success' : 'danger' ?>"><?= $data["status"] ?></div></td>
            <td class="uk-text-right">
                <button class="uk-button uk-button-mini uk-button-danger" type="button">Delete</button>
            </td>
        </tr>
    </tbody>
</table>
