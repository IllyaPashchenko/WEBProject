<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container" style="width: 50%">
    <form method="post">
        <div class="form-group">
            <label for="login_signin">Login</label>
            <input name="login" type="text" class="form-control" id="login_signin">
        </div>
        <div class="form-group">
            <label for="phone_signin">Phone</label>
            <input name="phone" type="text" class="form-control" id="phone_signin">
        </div>
        <div class="form-group">
            <label for="password_singin">Password</label>
            <input name="password" type="password" class="form-control" id="password_singin">
        </div>
        <div class="form-group">
            <label for="confirm_password_signin">Confirm password</label>
            <input name="confirm_password" type="password" class="form-control" id="confirm_password_signin">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php
    include 'db_conn.php';
    if (isset($_POST["login"]) && isset($_POST["phone"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $login = $_POST['login'];
        $phone = $_POST['phone'];

        if ($password == $confirm_password) {
            customer_registration($login, $password, $phone);
        } else {
            echo "Incorrect confimation password ";
        }
    }
?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>

</body>
</html>