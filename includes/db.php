<?php

$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = '';
$db['db_name'] = 'cms';
foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$connection) {
    die('Connection failed' . mysqli_error($connection));
}

$query = "SET NAMES utf8";
mysqli_query($connection, $query);

function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}

