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
if (isset($_POST['Kasir'])) {
    $nama_kasir = $_POST['Kasir'];
    $status = $_POST['status'];
    $no_hp = $_POST['no_hp'];
    $id_kamar = $_POST['id_kamar'];
    $cekin = $_POST['cekin'];
    $cekout = $_POST['cekout'];
    $jumlah = $_POST['jumlah'];
    $total = $_POST['total'];

    $sql = "INSERT INTO `sistem_kasir` (`id_sistem`, `Kasir`, `status`, `cekout`, `no_identitas`, `no_hp`, `id_admin`, `jumlah`, `total`) VALUES ('".$id_kamar."', '".$nama."', '".$cekin."', '".$cekout."', '".$no_identitas."', '".$no_hp."', '".$_SESSION['id_admin']."', '".$jumlah."', '".$total."')";

    mysqli_query($db, $sql);
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
    <nav class="navbar bg-transparent">
  <!-- <div class="container-fluid bg-transparent">
    <form class="d-flex bg-transparent rounded-0" role="search">
      <input class="form-control me-2 rounded-0" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success rounded-0" type="submit">Search</button>
    </form>
  </div> -->
</nav>
</div>
  <div class="p-2">
    <div class="buat-logout">
    <a class="btn btn-light border border-black rounded-0 mt-2" href="logout.php" role="button" style="width: 100%;">Logout</a>
    </div>
</div>
</div>
<hr>
<div>
    <!-- <h3 class="ms-5">Form Pemesanan</h3> -->
    <form method="POST">
    <table class="table ms-1" style="width: 90%">
  <thead>
    <tr class="table-primary">
      <th scope="col">No</th>
      <th scope="col">Nama lengkap</th>
      <th scope="col">No identitas</th>
      <th scope="col">No hp</th>
      <th scope="col">Jenis kamar</th>
      <th scope="col">Check in</th>
      <th scope="col">Check out</th>
      <th scope="col">Jumlah kamar</th>
      <th scope="col">Total</th>
      <th scope="col" colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>1</td>
        <td><input type="text" name="nama"></td>
        <td><input type="text" name="no_identitas"></td>
        <td><input type="text" name="no_hp"></td>
        <td>
                <select name="id_kamar" id="jenis_kamar">
                <?php
                    $sql = "SELECT * FROM tbl_jenis_kamar";
                    $query = mysqli_query($db, $sql);
                    while($kamar = mysqli_fetch_array($query)){
                        echo "<option value=".$kamar['id_kamar']." data-harga='".$kamar['harga']."'>".$kamar['jenis_kamar']." - Rp ".$kamar['harga']."</option>";
                    }
                    ?>
                </select>
            </td>
            <td><input type="date" name="cekin" id="cekin"></td>
            <td><input type="date" name="cekout" id="cekout"></td>
            <td><input type="text" name="jumlah" id="jumlah_kamar"></td>
            <td><input type="text" name="total" id="total_bayar"></td>
            <td>
                <button type="button" id="btn_hitung" onclick=hitung()>Hitung Total Bayar</button>
            </td>
            <td><input type="submit" value="Simpan Transaksi"></input></td>
    </tr>
    </form>
</div>
</body>
<script>
    function hitung(){
        var cekin = new Date(document.getElementById("cekin").value);
        var cekout = new Date(document.getElementById("cekout").value);
        var durasi = (cekout.getTime() - cekin.getTime()) / (1000 * 60 * 60 * 24);
        if (durasi == 0) {
            durasi = 1;
        }
        var jk = document.getElementById("jenis_kamar");
        var harga = jk.options[jk.selectedIndex].dataset.harga;
        var jumlah_kamar = document.getElementById("jumlah_kamar").value;
        document.getElementById("total_bayar").value = harga * jumlah_kamar * durasi; 
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>