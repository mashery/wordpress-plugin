<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Key</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $index => $key) {
            ?>
            <tr>
                <td><?= $key["name"] ?></td>
                <td><?= $key["key"] ?></td>
            </tr>
            <?php
        } ?>
    </tbody>
</table>
