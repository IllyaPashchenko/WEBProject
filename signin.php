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
            <label for="email_signin">Email address</label>
            <input name="email" type="email" class="form-control" id="email_signin" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
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
    if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $email = $_POST['email'];

        if ($password == $confirm_password) {
            echo "Correct input " . date("d-m-Y");
        } else {
            echo "Incorrect input " . date("d-m-Y");
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