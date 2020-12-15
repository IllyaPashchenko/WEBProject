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
function insert_game($name, $genre, $age_group, $description, $price) {
    global $link;
    $link->query("INSERT INTO TABLETOP_GAMES (GAME_NAME, GENRE, AGE_GROUP, DESCRIPTION, PRICE) VALUES ('$name', '$genre', '$age_group', '$description', $price)");
}

function customer_registration($login, $pass, $phone) {
    global $link;
    $link->query("INSERT INTO CUSTOMERS (LOGIN, PASSWORD, PHONE_NUMBER) VALUES ('$login', '$pass', '$phone')");
}

function update_customer($id, $login, $pass, $birth, $address, $phone, $email) {
    global $link;
    $link->query("UPDATE CUSTOMERS SET LOGIN='$login', PASSWORD='$pass', BIRTH_DATE='$birth', ADDRESS='$address', PHONE_NUMBER='$phone', EMAIL='$email' WHERE ID = '$id'");
}

function insert_admin($login, $pass, $birth, $address, $phone, $email) {
    global $link;
    $link->query("INSERT INTO ADMINS (LOGIN, PASSWORD, BIRTH_DATE, ADDRESS, PHONE_NUMBER, EMAIL) VALUES ('$login', '$pass', '$birth', '$address', '$phone', '$email')");
}

function update_admin($id, $login, $pass, $birth, $address, $phone, $email) {
    global $link;
    $link->query("UPDATE ADMINS SET LOGIN='$login', PASSWORD='$pass', BIRTH_DATE='$birth', ADDRESS='$address', PHONE_NUMBER='$phone', EMAIL='$email' WHERE ID = '$id'");
}

function insert_log($idAd, $idTG, $date) {
    global $link;
    $link->query("INSERT INTO LOGS (ID_ADMIN, ID_TABLETOP_GAME, DATE_TIME) VALUES ('$idAd', '$idTG', '$date')");
}

function insert_order($idCu, $idTG, $date, $address) {
    global $link;
    $link->query("INSERT INTO ORDERS (ID_CUSTOMER, ID_TABLETOP_GAME, DELIVERY_DATE, DELIVERY_ADDRESS) VALUES ('$idCu', '$idTG', '$date', '$address')");
}


function get_by_genre($name)
{
    global $link;
    return $link->query("SELECT * FROM TABLETOP_GAMES WHERE GENRE='" . $name . "'", MYSQLI_STORE_RESULT)
        ->fetch_all();
}

function get_by_age($age)
{
    global $link;
    return $link->query("SELECT * FROM TABLETOP_GAMES WHERE AGE_GROUP='" . $age . "'", MYSQLI_STORE_RESULT)
        ->fetch_all();
}

function get_by_price($min,$max)
{
    global $link;
    return $link->query("SELECT * FROM TABLETOP_GAMES WHERE PRICE BETWEEN '" . $min ."' AND '" . $max . "'", MYSQLI_STORE_RESULT)
        ->fetch_all();
}

function get_by_name($name)
{
    global $link;
    return $link->query("SELECT * FROM TABLETOP_GAMES WHERE GAME_NAME='%" . $name . "%'", MYSQLI_STORE_RESULT)
        ->fetch_all();
}


function orders_by_game($id)
{
    global $link;
    return $link->query("SELECT ORDERS.ID, CUSTOMERS.LOGIN, ORDERS.DELIVERY_DATE, ORDERS.DELIVERY_ADDRESS FROM ORDERS RIGHT JOIN CUSTOMERS ON CUSTOMERS.ID = ORDERS.ID_CUSTOMER WHERE ID_TABLETOP_GAME='" . $id . "'", MYSQLI_STORE_RESULT)
        ->fetch_all();
}

function orders_by_customer($id)
{
    global $link;
    return $link->query("SELECT ORDERS.ID, TABLETOP_GAMES.GAME_NAME, ORDERS.DELIVERY_DATE, ORDERS.DELIVERY_ADDRESS FROM ORDERS RIGHT JOIN TABLETOP_GAMES ON TABLETOP_GAMES.ID = ORDERS.ID_TABLETOP_GAME WHERE ID_CUSTOMER='" . $id . "'", MYSQLI_STORE_RESULT)
        ->fetch_all();
}

function logs_by_admin($id)
{
    global $link;
    return $link->query("SELECT LOGS.ID, TABLETOP_GAMES.GAME_NAME, LOGS.DATE_TIME FROM LOGS RIGHT JOIN TABLETOP_GAMES ON TABLETOP_GAMES.ID = LOGS.ID_TABLETOP_GAME WHERE ID_ADMIN='" . $id . "'", MYSQLI_STORE_RESULT)
        ->fetch_all();
}


function delete_customer($id) {
    global $link;
    $link->query("DELETE FROM CUSTOMERS WHERE ID = '" . $id . "'");
}
function delete_admin($id) {
    global $link;
    $link->query("DELETE FROM ADMINS WHERE ID = '" . $id . "'");
}
function delete_game($id) {
    global $link;
    $link->query("DELETE FROM TABLETOP_GAME WHERE ID = '" . $id . "'");
}