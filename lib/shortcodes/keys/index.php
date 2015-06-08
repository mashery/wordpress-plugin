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
                <td><a href="http://localhost/wordpress/keys/<?= $key["id"] ?>"><?= $key["apikey"] ?></td>
                <td><?= $key["created"] ?></td>
            </tr>
            <?php
        } ?>
    </tbody>
</table>
