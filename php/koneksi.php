<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'tokozakiah';

    $mysqli = new mysqli($host, $username, $password, $database);

    if ($mysqli->connect_errno) {
        echo "Gagal terhubung ke MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        exit();
    }
?>