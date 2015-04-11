<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Key</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $application) {
            ?>
            <tr>
                <td><?= $key ?></td>
                <td><?= $application["name"] ?></td>
                <td><?= $application["key"] ?></td>
            </tr>
            <?php
        } ?>
    </tbody>
</table>
