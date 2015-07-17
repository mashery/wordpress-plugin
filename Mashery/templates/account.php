<form class="uk-form">

    <div class="uk-grid" data-uk-grid-margin>

        <div class="uk-width-medium-1-3">
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
        </div>

        <div class="uk-width-medium-1-3">
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
        </div>

        <div class="uk-width-medium-1-3">
            <fieldset data-uk-margin>
                <legend>Notes...</legend>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            </fieldset>
        </div>


        <!-- <input type="submit" value="Delete Membership"> -->
        <!-- <input type="submit" value="Save Changes"> -->

</form>
