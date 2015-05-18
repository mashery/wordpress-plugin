<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Limits</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $api) {
            ?>
            <tr>
                <td><?= $api["name"] ?></td>
                <td>
                    <ol>
                    <?php foreach ($api["limits"] as $key => $limit) {
                        ?><li><?= $key ?>: <?= $api["limits"][$key] ?></li><?php
                    } ?>
                    </ol>
                </td>
                <td><input type="submit" value="Request Access"></td>
            </tr>
            <?php
        } ?>
    </tbody>
</table>
