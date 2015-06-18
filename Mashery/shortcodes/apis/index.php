<table class="mashery keys">
    <thead>
        <tr>
            <th>API</th>
            <th>Calls/Second</th>
            <th>Calls/Day</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $api) {
            ?>
            <tr>
                <td><?= $api["name"] ?></td>
                <td><?= $api["limits"]["cps"]; ?></td>
                <td><?= $api["limits"]["cpd"]; ?></td>
                <td><a href="request-access">Request Access</a></td>
            </tr>
            <?php
        } ?>
    </tbody>
</table>
