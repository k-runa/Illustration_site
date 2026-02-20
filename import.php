<?php
require "includes/db.php";
$sql = file_get_contents("data_only.sql");
// MySQLの書き方をPostgreSQL用に少し変換して実行します
$sql = str_replace(['`', '\"', 'ENGINE=InnoDB', 'DEFAULT CHARSET=utf8mb4'], '', $sql);
try {
    $dbh->exec($sql);
    echo "Data Import Success!";
} catch (PDOException $e) {
    echo "Import Error: " . $e->getMessage();
}
