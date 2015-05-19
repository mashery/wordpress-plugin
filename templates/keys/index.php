<table>
    <thead>
        <tr>
            <th>Key</th>
            <th>Created</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $index => $key) {
            ?>
            <tr>
                <td><?= $key["apikey"] ?></td>
                <td><?= $key["created"] ?></td>
            </tr>
            <?php
        } ?>
    </tbody>
</table>
