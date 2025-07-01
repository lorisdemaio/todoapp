<?php
    $user = 'root';
    $password = '';
    $host = 'localhost';
    $db = 'todoapp';

    $conn = mysqli_connect($host, $user, $password, $db);
    if ($conn === false) echo "errore: " . mysqli_connect_error();

    session_start();
?>