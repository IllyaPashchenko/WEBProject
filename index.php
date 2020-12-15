<?php
session_start();
require "db_conn.php";

if (isset($_GET['lang'])){
    $lang=$_GET['lang'];
    switch ($lang){
        case "ua" :
            setcookie("language", "Обрано українську мову", time()+15768000);
            break;
        case "ru" :
            setcookie("language", "Выбран русский язык", time()+15768000);
            break;
        case "en" :
            setcookie("language", "English language picked", time()+15768000);
            break;
    }
}
if(!isset($_COOKIE["language"])){
    setcookie("language", "Обрано українську мову", time()+15768000);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Кладовка игр</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <div class="row upper-menu">
        <div class="col-2">
            <h3>Кладовка игр</h3>
        </div>
        <div class="col-7">
            <div class="dropdown">
                <button style="background-color: coral" class="btn btn-secondary dropdown-toggle" type="button"
                        id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Жанры
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <a href="/?genre=strategy" class="dropdown-item" type="button">Стратегические</a>
                    <a href="/?genre=tactics" class="dropdown-item" type="button">Тактические</a>
                    <a href="/?genre=economy" class="dropdown-item" type="button">Экономические</a>
                    <a href="/?genre=logic" class="dropdown-item" type="button">Логические</a>
                    <a href="/?genre=military" class="dropdown-item" type="button">Военные</a>
                    <a href="/?genre=adventure" class="dropdown-item" type="button">Приключения</a>
                    <a href="/?genre=cards" class="dropdown-item" type="button">Карточные</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <a href="/?lang=ua" ><img style="width: 20px" src="images/ukraine_flag.png"/></a>
            <a href="/?lang=ru" ><img style="width: 20px" src="images/russian_flag.png"/></a>
            <a href="/?lang=en" ><img style="width: 20px" src="images/usa_flag.png"/></a>
            <a href="create_game.php" type="button" class="btn btn-light">+</a>
            <a href="signin.php" type="button" class="btn btn-light">Sign in</a>
            <a href="login.php" type="button" class="btn btn-success">Log in</a>
            <a href="/?reset=all" type="button" class="btn btn-success">Erase</a>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div style="margin-bottom: 10px" id="carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/slide1.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide2.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slide3.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="item"></div>
            </div>
            <div class="col">
                <div class="item"></div>
            </div>
            <div class="col">
                <div class="item"></div>
            </div>
            <div class="col">
                <div class="item"></div>
            </div>
        </div>
    </div>
</div>
<?php
echo $_COOKIE["language"];

if (isset($_GET['genre'])) {
    $games_set = get_by_genre($_GET['genre']);
    foreach ($games_set as $game) {
        echo $game[1] . '<br>';
    }
    echo $_SESSION["email"];
}
if (isset($_GET['reset']) && $_GET['reset']=='all') {
    recreate_table_customers();
    recreate_table_admins();
    recreate_table_games();
    recreate_table_logs();
    recreate_table_orders();
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