<style media="all">
    td {
        padding: 0;
    }
</style>
<table>
    <thead>
        <tr>
            <th>Status</th>
            <th>Key</th>
            <th>Created</th>
            <th>Rax. Req./Sec.</th>
            <th>Max. Req./Day</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $index => $key) {
            ?>
            <tr>
                <td><?= $key["status"] ?></td>
                <td><a href="<?= $key["id"] ?>"><?= $key["apikey"] ?></td>
                <td><?= $key["created"] ?></td>
                <td><?= $key["limits"][0]["ceiling"] ?></td>
                <td><?= $key["limits"][1]["ceiling"] ?></td>
                <td><input type="submit" value="Delete"></td>
            </tr>
            <?php
        } ?>
    </tbody>
</table>
