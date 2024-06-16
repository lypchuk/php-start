<?php
include $_SERVER["DOCUMENT_ROOT"]."/options.php";
try {
    $dbh = new PDO( DB_DRIVER.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);

    //$pdo = new PDO($dbh, DB_USER, DB_PASSWORD);
    // Set PDO to throw exceptions on errors
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";

    echo"Connection is good";
} catch (PDOException $e) {
    echo"Connection is BAD". $e->getMessage();
    exit();
    // attempt to retry the connection after some timeout for example
}