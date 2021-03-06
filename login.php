<?php
session_start();
require "db_conn.php";
$message = "";
if (isset($_POST["login"]) && isset($_POST["password"])) {
    $password = $_POST['password'];
    $login = $_POST['login'];

    if (correct_user($login, $password)){
        $_SESSION["login"] = $login;
        $_SESSION["password"] = $password;

        header('Location: /');
    } else {
        $message = "Пароль або Логін не правильні";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

<div class="container" style="width: 50%">
    <form method="post">
        <div class="form-group">
            <label for="login_login">Email address</label>
            <input name="login" type="text" class="form-control" id="login_login" value="<?= $_SESSION["login"] ?>">
        </div>
        <div class="form-group">
            <label for="password_login">Password</label>
            <input name="password" type="password" class="form-control" id="password_login" value="<?= $_SESSION["password"] ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php
    echo $message;
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>

</body>
</html>