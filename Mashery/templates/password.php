<form class="uk-form">
    <fieldset data-uk-margin>
        <legend>Password</legend>

        <div class="uk-form-row"><label for="current">Current Password:</label></div>
        <div class="uk-form-row"><input type="password" id="current" name="password[current]" placeholder="Current Password" value="<?= $data["password"] ?>"></div>

        <div class="uk-form-row"><label for="new">New Password:</label></div>
        <div class="uk-form-row"><input type="password" id="new" name="password[new]" placeholder="New Password" value=""></div>

        <div class="uk-form-row"><label for="confirmation">Confirmation:</label></div>
        <div class="uk-form-row"><input type="password" id="confirmation" name="password[confirmation]" placeholder="Confirmation" value=""></div>

        <div class="uk-form-row"><a class="uk-button uk-button-small" href="">Change Password</a></div>

    </fieldset>
</form>
