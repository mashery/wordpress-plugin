<form class="uk-form">
    <fieldset data-uk-margin>
        <legend>Personal Information</legend>

        <div class="uk-form-row"><label for="first">Name</label></div>
        <div class="uk-form-row"><input type="text" id="display_name" name="display_name" placeholder="John" value="<?= $data["display_name"] ?>" class="uk-form-width-medium"></div>

        <div class="uk-form-row"><label for="username">Username</label></div>
        <div class="uk-form-row"><input type="text" id="username" name="username" placeholder="Username" value="<?= $data["username"] ?>" class="uk-form-width-medium"></div>

        <div class="uk-form-row"><label for="web">Website URL</label></div>
        <div class="uk-form-row"><input type="text" id="web" name="web" placeholder="Website URL" value="<?= $data["uri"] ?>" class="uk-form-width-medium"></div>

        <div class="uk-form-row"><label for="phone">Phone:</label></div>
        <div class="uk-form-row"><input type="text" id="phone" name="phone" placeholder="(212) 555-1212" value="<?= $data["phone"] ?>" class="uk-form-width-medium"></div>

        <div class="uk-form-row"><label for="email">Email:</label></div>
        <div class="uk-form-row"><input type="text" id="email" name="email" placeholder="you@example.com" value="<?= $data["email"] ?>" class="uk-form-width-medium"></div>

        <div class="uk-form-row"><label for="company">Company:</label></div>
        <div class="uk-form-row"><input type="text" id="company" name="company" placeholder="ACME, Inc." value="<?= $data["company"] ?>" class="uk-form-width-medium"></div>

        <div class="uk-form-row"><button class="uk-button uk-button-small uk-button-success" type="submit">Save Changes</button></div>

    </fieldset>
</form>
