<!doctype html>
<html>
<head>

    <title>ChopBetta</title>
    <link rel="stylesheet" href="assets/css/style.css"/>
    <link rel="stylesheet" href="assets/css/foundation.min.css"/>
</head>
<body>

<nav class="top-bar" data-topbar role="navigation">
    <section class="top-bar-section">

        <ul class="left">
            <li><a href="#">Home</a></li>
            <li><a href="#" data-reveal-id="create_meal_modal" onclick="createNewCafeteria()">Create new Cafeteria</a>
            </li>
        </ul>
        <ul class="right">
            <li class="has-dropdown">
                <a href="#">Super Admin</a>
                <ul class="dropdown">
                    <li><a href="#">Logout</a></li>
                </ul>
            </li>
        </ul>
    </section>
</nav>

<main class="centerPage">

    <table class="responsive">
        <thead>
        <tr>
            <th>Cafeteria name</th>
            <th>Admin username</th>
            <th>Edit</th>
            <th width="150">Delete</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Content Goes Here</td>
            <td>This is longer content Donec id elit non mi porta gravida at eget metus.</td>
            <td><a href="#" data-reveal-id="edit_cafeteria_modal" onclick="editCafeteria()"><span title="Edit item"
                                                                                                  class="icon-edit"></span></a>
            </td>
            <td><a href="#" onclick="deleteCafeteria() "><span title="Delete item" class="icon-delete"></span></a></td>
        </tr>
        <tr>
            <td>Content Goes Here</td>
            <td>This is longer content Donec id elit non mi porta gravida at eget metus.</td>
            <td><a href="#" onclick="editCafeteria()"><span title="Edit item" class="icon-edit"></span></a></td>
            <td><a href="#" onclick="deleteCafeteria() "><span title="Delete item" class="icon-delete"></span></a></td>
        </tr>
        <tr>
            <td>Content Goes Here</td>
            <td>This is longer content Donec id elit non mi porta gravida at eget metus.</td>
            <td><a href="#" onclick="editCafeteria()"><span title="Edit item" class="icon-edit"></span></a></td>
            <td><a href="#" onclick="deleteCafeteria() "><span title="Delete item" class="icon-delete"></span></a></td>
        </tr>
        </tbody>
    </table>

    <div id="create_meal_modal" class="reveal-modal medium" data-reveal>
        <div id="cafeteria_name_box">
            <label>Name of new Cafeteria</label>

            <div class="large-9 columns" style="padding-left: 50">
                <input type="text">
            </div>

            <div class="large-3 columns" style="padding-left: 0">
                <button class="menuControl button postfix" onclick="addCafeteria()">Add cafeteria</button>
            </div>
        </div>
        <div id="cafeteria_vendor_box">
            <form>
                <fieldset>
                    <legend>Vendor information</legend>

                    <label>Vendor name
                        <input type="text" placeholder="this would be the username for logging in">
                    </label>
                    <label>Password
                        <input type="password" placeholder="Password">
                    </label>
                    <a class="button right">Create Vendor</a>
                </fieldset>
            </form>
        </div>
    </div>

    <div id="edit_cafeteria_modal" class="reveal-modal medium" data-reveal>
        <form>
            <fieldset>
                <legend>Cafeteria information</legend>
                <label>Cafeteria name
                    <input type="text" placeholder="Cafeteria name here">
                </label>
            </fieldset>
        </form>
        <form>
            <fieldset>
                <legend>Vendor information</legend>
                <label>Vendor name
                    <input type="text" placeholder="vendor name here">
                </label>

                <input id="checkbox2" type="checkbox">
                <label for="checkbox2">Change password</label>
                <label>Reset password
                    <input type="password" placeholder="Reset password"/>
                </label>
                <a class="button right">Save Changes</a>
            </fieldset>
        </form>
    </div>

</main>

</body>
<script src="assets/js/jquery-1.11.0.js" type="text/javascript"></script>
<script src="assets/js/mapDS.js" type="text/javascript"></script>
<script src="assets/js/super_user.js" type="text/javascript"></script>
<script src="assets/js/foundation.min.js" type="text/javascript"></script>
<script>
    $(document).foundation();
</script>
</html>