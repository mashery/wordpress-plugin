<form action="" id="application" name="application">

    <fieldset form="application" name="info">
        <legend>Register a new application:</legend>

        <ol>
            <li>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="My Awesome Applicaiton" value="<?= $data["name"] ?>">
            </li>
            <li>
                <label for="web">Website URL:</label>
                <input type="url" id="web" name="web" placeholder="Website URL" value="<?= $data["web"] ?>">
            </li>
            <li>
                <label for="description">Description:</label>
                <textarea name="Description" rows="" cols=""><?= $data["blog"] ?></textarea>
            </li>
            <li>
                <label for="callback">Callback URL:</label>
                <input type="url" id="callback" name="callback" placeholder="Callback URL" value="<?= $data["callback"] ?>">
            </li>
        </ol>

    </fieldset>

    <fieldset form="application" name="apis">
        <legend>Select APIs for this application:</legend>

        <ol>
            <?php foreach ($data['apis'] as $key => $api) {
                ?>
                <li>
                    <label for="api_<?= $data['apis'][$key] ?>_included">
                        <input type="checkbox" id="api_<?= $data['apis'][$key] ?>_included" name="api[<?= $data['apis'][$key] ?>][included]" value="<?= $data["apis"][$key]["included"] ?>">
                        <?= $data["apis"][$key]["name"] ?>
                    </label>
                    <!-- List of plans available for this api -->
                </li>
                <?php
            } ?>
        </ol>

    </fieldset>

    <fieldset form="application" name="terms">
        <legend>Terms of Service:</legend>

        <ol>
            <li>
                Please review the information that you have entered above and agree to the terms of service.
                <label for="api_123_included">
                    <input type="checkbox" id="api_123_included" name="api[123][included]" value="<?= $data["apis"]["123"]["included"] ?>">
                    I agree to the terms of the service.
                </label>
                <!-- List of plans available for this api -->
            </li>
        </ol>

    </fieldset>

    <input type="submit" value="Register Application">
</form>
