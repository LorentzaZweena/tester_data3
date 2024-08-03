<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produk = $_POST['id_produk'];
    $id_finishing = $_POST['id_finishing'];

    $sql = "UPDATE produk SET finishing = (SELECT finishing FROM finishing WHERE id_finishing = ?) WHERE id_produk = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_finishing, $id_produk);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Success";
    } else {
        echo "Error";
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($db);
?>