<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php 
    include("config.php"); 
?>
<?php
if (isset($_POST['submit'])) {
    $nama_kasir = $_POST['Kasir'];
    $status = $_POST['id_status'];
    $payment = $_POST['id_payment'];
    $no_hp = $_POST['no_hp'];
    $customer = $_POST['Customer'];
    $alamat = $_POST['Alamat'];
    $kota = $_POST['id_kota'];
    $sumber = $_POST['id_sumber'];
    $item_produk = $_POST['id_produk'];
    $qty = $_POST['QTY'];
    $discount = $_POST['Discount'];
    $delivery = $_POST['delivery'];
    $harga_per_item = $_POST['harga_per_item'];
    $packing = $_POST['packing'];
    $total = $_POST['total'];

    $sql = mysqli_query($db, "INSERT INTO sistem_kasir (Kasir, statusnya, payment, no_hp, id_kasir, id_status, id_payment, id_kota, id_sumber, Customer, Alamat, Kota, Sumber, produk_item, QTY, Discount, harga_per_item, delivery, packing, grand_total) VALUES ('".$nama_kasir."', '".$status."', '".$payment."', '".$no_hp."', '".$customer."', '".$alamat."', '".$kota."', '".$sumber."', '".$item_produk."', '".$qty."', '".$discount."', '".$harga_per_item."', '".$delivery."', '".$packing."', '".$total."')");

    // mysqli_query($db, $sql);
    header("location:sistem_kasir.php");
}

?>
    <!-- judul halaman -->
    <h3 class="mt-5 ms-5">Sistem kasir form</h3>

    <!-- navigasi untuk mengakses data kamar dan data lainnya -->
    <div class="d-flex flex-row ms-n2">
        <div class="p-2">
            <div class="dropdown">
                <button class="btn btn-light border border-secondary dropdown-toggle dropdown-toggle-split rounded-0 ms-5 mt-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    All table
                </button>
                <ul class="dropdown-menu mt-2">
                    <li><a class="dropdown-item" href="sistem_kasir.php">Sistem kasir</a></li>
                    <li><a class="dropdown-item" href="kasir.php">Data kasir</a></li>
                </ul>
            </div>
        </div>
        <div class="p-2">
            <nav class="navbar bg-transparent"></nav>
        </div>
        <div class="p-2">
            <div class="buat-logout">
                <a class="btn btn-light border border-black rounded-0 mt-2" href="logout.php" role="button" style="width: 100%;">Logout</a>
            </div>
        </div>
    </div>
    <hr>
    <div>
        <form method="POST" id="kasir-form" action="">
            <table class="table ms-1" style="width: 90%">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">No</th>
                        <th scope="col">Nama kasir</th>
                        <th scope="col">Status</th>
                        <th scope="col">Payment</th>
                        <th scope="col">Nomor HP</th>
                        <th scope="col">Nama customer</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Kota</th>
                        <th scope="col">Sumber</th>
                        <th scope="col">Item produk</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Harga / item</th>
                        <th scope="col">Delivery</th>
                        <th scope="col">Packing</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <select name="Kasir" id="nama">
                                <?php
                                    $sql = "SELECT * FROM kasir";
                                    $query = mysqli_query($db, $sql);
                                    while($nama = mysqli_fetch_array($query)){
                                        echo "<option value='" . $nama['Kasir'] . "'>" . $nama['nama'] . "</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="id_status" id="status">
                                <?php
                                    $sql = "SELECT * FROM statusnya";
                                    $query = mysqli_query($db, $sql);
                                    while($status = mysqli_fetch_array($query)){
                                        echo "<option value='" . $status['id_status'] . "'>" . $status['status'] . "</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="id_payment" id="payment">
                                <?php
                                    $sql = "SELECT * FROM payment";
                                    $query = mysqli_query($db, $sql);
                                    while($payment = mysqli_fetch_array($query)){
                                        echo "<option value='" . $payment['id_payment'] . "'>" . $payment['payment'] . "</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td><input type="text" name="no_hp" id="no_hp"></td>
                        <td><input type="text" name="Customer" id="Customer"></td>
                        <td><input type="text" name="Alamat" id="Alamat"></td>
                        <td>
                            <select name="id_kota" id="kota">
                                <?php
                                    $sql = "SELECT * FROM kota";
                                    $query = mysqli_query($db, $sql);
                                    while($kota = mysqli_fetch_array($query)){
                                        echo "<option value='" . $kota['id_kota'] . "'>" . $kota['kota'] . "</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="id_sumber" id="sumber">
                                <?php
                                    $sql = "SELECT * FROM sumber";
                                    $query = mysqli_query($db, $sql);
                                    while($sumber = mysqli_fetch_array($query)){
                                        echo "<option value='" . $sumber['id_sumber'] . "'>" . $sumber['sumber'] . "</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="id_produk" id="produk">
                                <?php
                                    $sql = "SELECT * FROM produk";
                                    $query = mysqli_query($db, $sql);
                                    while($produk = mysqli_fetch_array($query)){
                                        echo "<option value=".$produk['id_produk']." data-harga='".$produk['harga_jual']."'>".$produk['nama_produk']." - Rp ".$produk['harga_jual']."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td><input type="number" name="QTY" id="QTY"></td>
                        <td><input type="text" name="Discount" id="Discount"></td>
                        <td><input type="text" name="harga_per_item" id="harga_per_item"></td>
                        <td><input type="text" name="delivery" id="delivery"></td>
                        <td><input type="text" name="packing" id="packing"></td>
                        <td><input type="text" name="total" id="total"></td>
                        <td><button type="button" id="btn_hitung" onclick="hitung()">Hitung Total Bayar</button></td>
                        <td><button type="submit" value="Simpan data" name="submit">Simpan data</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</body>
<script>
    function hitung() {
        var QTY = new Number(document.getElementById("QTY").value);
        var Discount = new Number(document.getElementById("Discount").value);
        var Packing = new Number(document.getElementById("packing").value);
        
        var p = document.getElementById("produk");
        var harga = p.options[p.selectedIndex].dataset.harga;
        
        document.getElementById("total").value = harga * QTY; 
        var hitung_discount = (harga * 1 - (Discount));
        if (hitung_discount == 0) {
            hitung_discount = 1;
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>