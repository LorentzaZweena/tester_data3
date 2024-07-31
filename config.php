<?php
    //nama server
    $server = "localhost";

    //username database
    $user = "root";

    //password database
    $password = "";

    //nama database
    $nama_database = "db_produk";

    $db = mysqli_connect($server, $user, $password, $nama_database);
    if(!$db){
        die("Gagal terhubung dengan database: " . mysqli_connect_error());
    }

    //memulai session php
    session_start();
?>