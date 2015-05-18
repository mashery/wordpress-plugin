<form action="" id="application" name="application">

    <fieldset form="application" name="info">
        <legend>Register a new application:</legend>

        <ol>
            <li>
                <label for="full_name">Full Name:</label>
                <?= $data["account"]["name"]["first"] ?> <?= $data["account"]["name"]["last"] ?>
            </li>
            <li>
                <label for="username">User Name:</label>
                <?= $data["account"]["username"] ?>
            </li>
            <li>
                <label for="email">Email:</label>
                <?= $data["account"]["email"] ?>
            </li>
            <li>
                <label for="api">API:</label>
                <?= $data["api"]["name"] ?>
            </li>
            <li>
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" placeholder="Subject" value="">
            </li>
            <li>
                <label for="callback">Message:</label>
                <textarea name="message" rows="" cols=""></textarea>
            </li>
        </ol>

    </fieldset>

    <input type="submit" value="Request Access">

</form>
