<form action="" id="account" name="account">

    <style media="screen">
        fieldset {
            margin-bottom: 20px;
        }
        legend {
            font-weight: bold;
            margin: 20px 0;
        }
        label {
            width: 250px;
            display: inline-block;
        }
    </style>

    <fieldset form="account" name="info">

        <legend>Info:</legend>

        <label for="first">Name:</label>
        <input type="text" id="display_name" name="display_name" placeholder="John" value="<?= $data["display_name"] ?>"><br/>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Username" value="<?= $data["username"] ?>"><br/>

        <label for="web">Website URL:</label>
        <input type="text" id="web" name="web" placeholder="Website URL" value="<?= $data["uri"] ?>"><br/>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" placeholder="(212) 555-1212" value="<?= $data["phone"] ?>"><br/>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" placeholder="you@example.com" value="<?= $data["email"] ?>"><br/>

        <label for="company">Company:</label>
        <input type="text" id="company" name="company" placeholder="ACME, Inc." value="<?= $data["company"] ?>"><br/>

    </fieldset>

    <fieldset form="account" name="password">
        <legend>Password:</legend>

        <label for="current">Current Password:</label>
        <input type="password" id="current" name="password[current]" placeholder="Current Password" value="<?= $data["password"] ?>"><br/>

        <label for="new">New Password:</label>
        <input type="password" id="new" name="password[new]" placeholder="New Password" value=""><br/>

        <label for="confirmation">New Password Confirmation:</label>
        <input type="password" id="confirmation" name="password[confirmation]" placeholder="Confirmation" value="">

    </fieldset>

    <input type="submit" value="Delete Membership">
    <input type="submit" value="Save Changes">
</form>
