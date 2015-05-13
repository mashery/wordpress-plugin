<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Key</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $api) {
            ?>
            <tr>
                <td><?= $api["name"] ?></td>
                <td><?= $api["key"] ?></td>
            </tr>
            <?php
        } ?>
    </tbody>
</table>
