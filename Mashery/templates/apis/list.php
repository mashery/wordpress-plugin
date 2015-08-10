<?php if(is_array($data) && count($data)) { ?>
<table class="uk-table uk-table-striped uk-table-hover uk-text-nowrap">
    <thead>
        <tr>
            <th>Name</th>
            <th>Created</th>
            <th>Package</th>
            <th>Plan</th>
            <th class="uk-text-center">Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $index => $api): ?>
        <tr>
            <td>
                <!-- <a href="<?= add_query_arg( 'key', $api["id"], get_permalink( get_option( 'mashery_api_page' ) ) ) ?>"> -->
                    <?= $api["name"] ?>
                <!-- </a> -->
            </td>
            <td><?= date("M jS, Y", strtotime($api["created"])) ?></td>
            <td><?= $api["package"] ?></td>
            <td><?= $api["plan"] ?></td>
            <td class="uk-text-center"><div class="uk-badge uk-badge-<?= ($api["status"] == 'active') ? 'success' : 'danger' ?>"><?= $api["status"] ?></div></td>
            <td class="uk-text-right">
                <a class="uk-button uk-button-mini uk-button-success mash-key-new-btn" href="<?= add_query_arg( 'action', 'add', add_query_arg( 'api', $api["id"], get_permalink( get_the_ID() ) ) ) ?>">
                    Create New Key
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php } else { ?>
    <div class="uk-alert uk-alert-warning">We could not find any APIs for you. Please contact us for assistance.</div>
<?php } ?>
