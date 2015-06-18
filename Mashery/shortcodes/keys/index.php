<table class="uk-table uk-table-hover">
    <thead>
        <tr>
            <th>Status</th>
            <th>Key</th>
            <th>Created</th>
            <th>Quota (per sec/day)</th>
            <th>App</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $index => $key) {
            ?>
            <tr>
                <td><?= $key["status"] ?></td>
                <td><a href="<?= $key["id"] ?>" title="<?= $key["apikey"] ?>"><?= substr($key["apikey"], 0, 6) . "..." ?></td>
                <td><?= $key["created"] ?></td>
                <td>
                    <?= $key["limits"][0]["ceiling"] ?>/<?= $key["limits"][1]["ceiling"] ?>
                </td>
                <td>
                    <select class="" name="">
                        <option>App 1</option>
                        <option>App 2</option>
                        <option>App 3</option>
                    </select>
                </td>
                <td>
                    <a href="#"><i class="uk-icon-share"></i></a>
                    <a href="#"><i class="uk-icon-trash"></i></a>
                </td>
            </tr>
            <?php
        } ?>
    </tbody>
</table>
