<?php

function connectToDatabase($servername, $dbname) {
    $connectionOptions = array(
        "Database" => $dbname,
        "UID" => "", // Jika tidak menggunakan autentikasi SQL Server
        "PWD" => "", // Jika tidak ada password
    );

    $conn = sqlsrv_connect($servername, $connectionOptions);
    if (!$conn) {
        die("Connection failed: " . print_r(sqlsrv_errors(), true));
    } else {

