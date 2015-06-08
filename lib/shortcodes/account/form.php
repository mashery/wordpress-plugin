<form action="" id="account" name="account">

    <fieldset form="account" name="info">
        <legend>Info:</legend>

        <ol>
            <li>
                <label for="first">Name:</label>
                <input type="text" id="first" name="name[first]" placeholder="John" value="<?= $data["name"]["first"] ?>">
                <input type="text" id="last" name="name[last]" placeholder="Smyth" value="<?= $data["name"]["last"] ?>">
            </li>
            <li>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Username" value="">
            </li>
            <li>
                <label for="web">Website URL:</label>
                <input type="url" id="web" name="web" placeholder="Website URL" value="<?= $data["web"] ?>">
            </li>
            <li>
                <label for="blog">Blog URL:</label>
                <input type="url" id="blog" name="blog" placeholder="Blog URL" value="<?= $data["blog"] ?>">
            </li>
            <li>
                <label for="phone">Phone:</label>
                <input type="phone" id="phone" name="phone" placeholder="(212) 555-1212" value="<?= $data["phone"] ?>">
            </li>
            <li>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" value="<?= $data["email"] ?>">
            </li>
            <li>
                <label for="company">Company:</label>
                <input type="text" id="company" name="company" placeholder="ACME, Inc." value="<?= $data["company"] ?>">
            </li>
        </ol>

    </fieldset>

    <fieldset form="account" name="password">
        <legend>Password:</legend>

        <ol>
            <li>
                <label for="current">Company:</label>
                <input type="password" id="current" name="password[current]" placeholder="Current Password" value="<?= $data["password"] ?>">
            </li>
            <li>
                <label for="new">Company:</label>
                <input type="password" id="new" name="password[new]" placeholder="New Password" value="">
            </li>
            <li>
                <label for="confirmation">Company:</label>
                <input type="password" id="confirmation" name="password[confirmation]" placeholder="Confirmation" value="">
            </li>
        </ol>
    </fieldset>

    <input type="submit" value="Delete Membership">
    <input type="submit" value="Save Changes">
</form>
