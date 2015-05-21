<?php if (sizeof($data) == 0) {
    ?>
<p>Click here to create your first application!</p>    

    <?php
    } else {
    ?>
    <table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Created</th>
            <th># of Keys</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $application) {
            ?>
            <tr>
                <td><a href="<?= $application["id"] ?>"><?= $application["name"] ?></td>
                <td><?= $application["created"] ?></td>
                <td><?= sizeof($application["package_keys"]) ?></td>
            </tr>
            <?php
        } ?>
    </tbody>
</table>
    <?php
    } ?>
