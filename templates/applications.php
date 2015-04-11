<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Key</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $application) {
            ?>
            <tr>
                <td><?= $application["name"] ?></td>
                <td><?= $application["key"] ?></td>
            </tr>
            <?php
        } ?>
    </tbody>
</table>
