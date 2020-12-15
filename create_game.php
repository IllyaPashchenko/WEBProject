<?php
    require 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create game</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container" style="width: 50%">
    <form method="post" >
        <div class="form-group">
            <label for="name">Name</label>
            <input name="game_name" type="text" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="genre">Genre</label>
            <input name="game_genre" type="text" class="form-control" id="genre">
        </div>
        <div class="form-group">
            <label for="age_group">Age group</label>
            <input name="age_group" type="text" class="form-control" id="age_group">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input name="description" type="text" class="form-control" id="description">
        </div>
        <div class="form-group">
            <label for="price">Price in $</label>
            <input name="price" type="text" class="form-control" id="price">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php
if (isset($_POST["game_name"]) && isset($_POST["game_genre"]) && isset($_POST["age_group"]) && isset($_POST["description"]) && isset($_POST["price"])) {
    $name = $_POST["game_name"];
    $genre = $_POST["game_genre"];
    $age_group = $_POST["age_group"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    insert_game($name, $genre, $age_group, $description, $price);
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