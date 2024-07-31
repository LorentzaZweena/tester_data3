<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .tambah-data{
            margin-left: 60em;
        }

        th{
            text-align: center;
        }

        td{
            text-align: center;
        }
    </style>
</head>
<body>
    <?php 
        include("config.php");
    ?>

    <!-- judul halaman -->
    <h3 class="mt-5 ms-5">Sistem kasir</h3>

    <!-- navigasi untuk mengakses data kamar dan data lainnya -->
    <div class="d-flex flex-row ms-n2">
  <div class="p-2">
  <div class="dropdown">
  <button class="btn btn-light border border-secondary dropdown-toggle dropdown-toggle-split rounded-0 ms-5 mt-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    All table
  </button>
  <ul class="dropdown-menu mt-2">
    <li><a class="dropdown-item" href="kamar_read.php">Data produk</a></li>
    <li><a class="dropdown-item" href="kasir.php">Data kasir</a></li>
  </ul>
</div>
  </div>
  <div class="p-2">
    <a class="btn btn-light border border-black rounded-0 mt-2 ms-n3" href="logout.php" role="button" style="width: 100%;">Logout</a>
</div>
<div class="tambah-data">
    <div class="p-2 ms-5">
        <a class="btn btn-success mt-2 ms-n3" href="tambah.php" role="button">Tambah data</a>
    </div>
</div>
</div>
    <br><br>
    <table class="table ms-5" style="width: 90%">
  <thead>
    <tr class="table-primary">
      <th scope="col">No</th>
      <th scope="col">Nama kasir</th>
      <th scope="col">Status</th>
      <th scope="col">Payment</th>
      <th scope="col">Nomor HP</th>
      <th scope="col">Nama Customer</th>
      <th scope="col">Alamat</th>
      <th scope="col">Kota</th>
      <th scope="col">Sumber</th>
      <th scope="col">Item produk</th>
      <th scope="col">QTY</th>
      <th scope="col">Discount</th>
      <th scope="col">Price / item</th>
      <!-- <th scope="col">Each total / customer</th> -->
      <th scope="col">Delivery</th>
      <th scope="col">Packing</th>
      <th scope="col">Total</th>
      <!-- <th scope="col">Action</th> -->
    </tr>
  </thead>
  <tbody>
  <?php 
            // $sql = "SELECT sistem_kasir.*  AS id_sistem_kasir, sistem_kasir.id_produk AS id_produk, sistem_kasir.id_kasir AS id_kasir,sistem_kasir.id_status AS id_status, sistem_kasir.id_payment AS id_payment, sistem_kasir.id_kota AS id_kota,sistem_kasir.id_sumber AS id_sumber,kasir.nama AS nama_kasir,statusnya.status AS status,payment.payment AS payment,kota.kota AS kota,sumber.sumber AS sumber,produk.nama_produk AS produk FROM sistem_kasir JOIN produk ON sistem_kasir.id_produk = produk.id_produk JOIN kasir ON sistem_kasir.id_kasir = kasir.id_kasir JOIN statusnya ON sistem_kasir.id_status = statusnya.id_status JOIN payment ON sistem_kasir.id_payment = payment.id_payment JOIN kota ON sistem_kasir.id_kota = kota.id_kota JOIN sumber ON sistem_kasir.id_sumber = sumber.id_sumber;";

            $sql = "SELECT sistem_kasir.*, kasir.nama AS nama_kasir, statusnya.status AS status, payment.payment AS payment, kota.kota AS kota, sumber.sumber AS sumber, produk.nama_produk AS produk 
                FROM sistem_kasir 
                JOIN produk ON sistem_kasir.id_produk = produk.id_produk 
                JOIN kasir ON sistem_kasir.id_kasir = kasir.id_kasir 
                JOIN statusnya ON sistem_kasir.id_status = statusnya.id_status 
                JOIN payment ON sistem_kasir.id_payment = payment.id_payment 
                JOIN kota ON sistem_kasir.id_kota = kota.id_kota 
                JOIN sumber ON sistem_kasir.id_sumber = sumber.id_sumber";
            $query = mysqli_query($db, $sql);
            $no = 1;
            function fetchOptions($db, $table, $idColumn, $nameColumn) {
                $sql = "SELECT $idColumn, $nameColumn FROM $table";
                $query = mysqli_query($db, $sql);
                $options = [];
                while ($data = mysqli_fetch_assoc($query)) {
                    $options[] = $data;
                }
                return $options;
            }

            //variable buat dropdown
            $kasir_options = fetchOptions($db, 'kasir', 'id_kasir', 'nama');
            $status_options = fetchOptions($db, 'statusnya', 'id_status', 'status');
            $payment_options = fetchOptions($db, 'payment', 'id_payment', 'payment');
            $kota_options = fetchOptions($db, 'kota', 'id_kota', 'kota');
            $sumber_options = fetchOptions($db, 'sumber', 'id_sumber', 'sumber');


            while($data=mysqli_fetch_array($query)){
                $id = isset($data['id']) ? $data['id'] : '';

                echo "<tr>";
                echo "<td>".$no++."</td>";
                echo "<td>";

                //dropdown nama kasir
                if (!isset($kasir_options) || !isset($data)) {
                    echo "Error: Ada yang salah dengan codingan nya.";
                    exit;
                }
                
                echo "<select class='form-select wide-select' data-id='".$id."' data-type='kasir'>";
                foreach ($kasir_options as $kasir) {
                    $selected = $kasir['id_kasir'] == $data['id_kasir'] ? 'selected' : '';
                    echo "<option value='".$kasir['id_kasir']."' $selected>".$kasir['nama']."</option>";
                }
                echo "</select>";
                echo "</td>";
                //dropdown kasir

                //dropdown status
                if (!isset($status_options) || !isset($data)) {
                    echo "Error: Missing information.";
                    exit;
                }
                
                echo "<td>";
                echo "<select class='form-select wide-select' data-id='".$id."' data-type='status'>";
                foreach ($status_options as $status) {
                    $selected = $status['id_status'] == $data['id_status'] ? 'selected' : '';
                    echo "<option value='".$status['id_status']."' $selected>".$status['status']."</option>";
                }
                echo "</select>";
                echo "</td>";
                //dropdown status

                //dropdown payment
                if (!isset($payment_options) || !isset($data)) {
                    echo "Error: Missing required data.";
                    exit;
                }
                
                echo "<td>";
                echo "<select class='form-select wide-select' data-id='".$id."' data-type='payment'>";
                foreach ($payment_options as $payment) {
                    $selected = $payment['id_payment'] == $data['id_payment'] ? 'selected' : '';
                    echo "<option value='".$payment['id_payment']."' $selected>".$payment['payment']."</option>";
                }
                echo "</select>";
                echo "</td>";
                //dropdown payment

                echo "<td>".$data['no_hp']."</td>";
                echo "<td>".$data['Customer']."</td>";

                //dropdown kota
                if (!isset($kota_options) || !isset($data)) {
                    echo "Error: Missing required data.";
                    exit;
                }
                
                echo "<td>".$data['Alamat']."</td>";
                
                echo "<td>";
                echo "<select class='form-select wide-select' data-id='".$data['id_kota']."' data-type='kota'>";
                foreach ($kota_options as $kota) {
                    $selected = $kota['id_kota'] == $data['id_kota'] ? 'selected' : '';
                    echo "<option value='".$kota['id_kota']."' $selected>".$kota['kota']."</option>";
                }
                echo "</select>";
                echo "</td>";

                //dropdown sumber
                if (!isset($sumber_options) || !isset($data)) {
                    echo "Error: Missing required data.";
                    exit;
                }
                
                echo "<td>";
                echo "<select class='form-select wide-select' data-id='".$data['id_sumber']."' data-type='sumber'>";
                foreach ($sumber_options as $sumber) {
                    $selected = $sumber['id_sumber'] == $data['id_sumber'] ? 'selected' : '';
                    echo "<option value='".$sumber['id_sumber']."' $selected>".$sumber['sumber']."</option>";
                }
                echo "</select>";
                echo "</td>";

                echo "<td>".$data['produk_item']."</td>";
                echo "<td>".$data['QTY']."</td>";
                echo "<td>".$data['Discount']."</td>";
                echo "<td>".$data['harga_per_item']."</td>";
                echo "<td>".$data['delivery']."</td>";
                echo "<td>".$data['packing']."</td>";
                echo "<td>".$data['grand_total']."</td>";
                // echo "<td>";
                // echo "<a href='penyewaan_update.php?id=".$data['id_kasir']."'>Edit</a> |";
                // echo "<a href='penyewaan_delete.php?id=".$data['id_kasir']."'> Delete</a>";
                // echo "</td>";
                echo "</tr>";
            }
        ?>
  </tbody>
</table>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>