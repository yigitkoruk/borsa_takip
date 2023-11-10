<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "borsa_takip";

$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_error) {
    die("Connect Error: " . $connect->connect_error);
}