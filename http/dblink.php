<?php
$host = "127.0.0.1";
$port = 3306;
$socket = "/tmp/mysql.sock";
$user = "user";
$password = "123";
$dbname = "start_page";

$db_link = mysqli_connect($host, $user, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Failed to connect ot MySQL: " . mysqli_connect_errno();
} else {
    $db_link->set_charset('utf8');
}