<?php

$link = mysqli_connect("db", "admin", "example", "webdatabase");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

function recreate_table_customers()
{
    global $link;
    $link->query("DROP TABLE IF EXISTS CUSTOMERS");
    $link->query("CREATE TABLE CUSTOMERS (
                        ID int PRIMARY KEY auto_increment,
                        LOGIN varchar(20) NOT NULL UNIQUE,
                        PASSWORD varchar(32) NOT NULL UNIQUE,
                        BIRTH_DATE date,
                        ADDRESS varchar(100),
                        PHONE_NUMBER varchar(13) NOT NULL UNIQUE,
                        EMAIL varchar(100) UNIQUE
                )");
}

function recreate_table_admins()
{
    global $link;
    $link->query("DROP TABLE IF EXISTS ADMINS");
    $link->query("CREATE TABLE ADMINS (
                        ID int PRIMARY KEY auto_increment,
                        LOGIN varchar(20) NOT NULL UNIQUE,
                        PASSWORD varchar(32) NOT NULL UNIQUE,
                        BIRTH_DATE date,
                        ADDRESS varchar(100),
                        PHONE_NUMBER varchar(13) NOT NULL UNIQUE,
                        EMAIL varchar(100) UNIQUE
                )");
}

function recreate_table_games()
{
    global $link;
    $link->query("DROP TABLE IF EXISTS TABLETOP_GAMES");
    $link->query("CREATE TABLE TABLETOP_GAMES (
                        ID int PRIMARY KEY auto_increment,
                        GAME_NAME varchar(30) NOT NULL,
                        GENRE ENUM('strategy', 'tactics', 'economy', 'logic', 'military', 'adventure', 'cards') NOT NULL,
                        AGE_GROUP ENUM('3-5', '6-7', '8-12', '13-15', '16-17', '18+') NOT NULL,
                        DESCRIPTION text NOT NULL,
                        PRICE int NOT NULL
                 )");
}

function recreate_table_orders()
{
    global $link;
    $link->query("DROP TABLE IF EXISTS ORDERS");
    $link->query("CREATE TABLE ORDERS (
                        ID int PRIMARY KEY auto_increment,
                        ID_CUSTOMER int NOT NULL,
                        ID_TABLETOP_GAME int NOT NULL,
                        DELIVERY_DATE date NOT NULL,
                        DELIVERY_ADDRESS varchar(100) NOT NULL,
                        FOREIGN KEY (ID_CUSTOMER) REFERENCES CUSTOMERS (ID),
                        FOREIGN KEY (ID_TABLETOP_GAME) REFERENCES TABLETOP_GAMES(ID) 
                )");
}

function recreate_table_logs()
{
    global $link;
    $link->query("DROP TABLE IF EXISTS LOGS");
    $link->query("CREATE TABLE LOGS (
                        ID int PRIMARY KEY auto_increment,
                        ID_ADMIN int NOT NULL,
                        ID_TABLETOP_GAME int NOT NULL,
                        DATE_TIME datetime NOT NULL,
                        FOREIGN KEY (ID_ADMIN) REFERENCES ADMINS(ID),
                        FOREIGN KEY (ID_TABLETOP_GAME) REFERENCES TABLETOP_GAMES(ID)
                )");
}

function get_by_genre($name)
{
    global $link;
    return $link->query("SELECT * FROM TABLETOP_GAMES WHERE GENRE='" . $name . "'", MYSQLI_STORE_RESULT)
        ->fetch_all();
}

function insert_game($name, $genre, $age_group, $description, $price) {
    global $link;
    $link->query("INSERT INTO TABLETOP_GAMES (GAME_NAME, GENRE, AGE_GROUP, DESCRIPTION, PRICE) VALUES ('$name', '$genre', '$age_group', '$description', $price)");
}

function correct_user($email, $password) {
    global $link;
    $result = $link->query("SELECT COUNT(*) from CUSTOMERS where EMAIL = '" . $email . "' and PASSWORD = '" . $password . "';") -> fetch_all();
    return $result[0][0] != 0;
}