<form action="" id="account" name="account">

    <fieldset form="account" name="info">
        <legend>Info222:</legend>

        <label for="first">Name:</label>
        <input type="text" id="first" name="name[first]" placeholder="John" value="<?= $data["name"]["first"] ?>">
        <input type="text" id="last" name="name[last]" placeholder="Smyth" value="<?= $data["name"]["last"] ?>">

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Username" value="">

        <label for="web">Website URL:</label>
        <input type="text" id="web" name="web" placeholder="Website URL" value="<?= $data["web"] ?>">

        <label for="blog">Blog URL:</label>
        <input type="text" id="blog" name="blog" placeholder="Blog URL" value="<?= $data["blog"] ?>">

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" placeholder="(212) 555-1212" value="<?= $data["phone"] ?>">

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" placeholder="you@example.com" value="<?= $data["email"] ?>">

        <label for="company">Company:</label>
        <input type="text" id="company" name="company" placeholder="ACME, Inc." value="<?= $data["company"] ?>">

    </fieldset>

    <fieldset form="account" name="password">
        <legend>Password:</legend>

        <label for="current">Company:</label>
        <input type="password" id="current" name="password[current]" placeholder="Current Password" value="<?= $data["password"] ?>">

        <label for="new">Company:</label>
        <input type="password" id="new" name="password[new]" placeholder="New Password" value="">

        <label for="confirmation">Company:</label>
        <input type="password" id="confirmation" name="password[confirmation]" placeholder="Confirmation" value="">

    </fieldset>

    <input type="submit" value="Delete Membership">
    <input type="submit" value="Save Changes">
</form>
