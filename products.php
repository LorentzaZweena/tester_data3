<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .tambah-data{
            margin-left: 55em;
        }
        .alert-container {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050;
            width: 80%;
            max-width: 600px;
        }
    </style>
</head>
<body>
    <?php 
        include("config.php");
    ?>

    <!-- judul halaman -->
    <h3 class="mt-5 ms-5">Products</h3>

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
                    <!-- <li><a class="dropdown-item" href="penyewaan_read.php">ERROR</a></li> -->
                </ul>
            </div>
        </div>
        <div class="p-2">
            <a class="btn btn-light border border-black rounded-0 mt-2 ms-n3" href="logout.php" role="button" style="width: 100%;">Logout</a>
        </div>
        <div class="tambah-data">
            <div class="p-2 ms-5">
                <a class="btn btn-success mt-2 ms-n3" href="kamar_create.php" role="button">Tambah data</a>
            </div>
        </div>
    </div>
    <br><br>
    
    <!-- Alert containers -->
    <div class="alert-container">
        <div id="success-alert" class="alert alert-success alert-dismissible fade" role="alert">
            <strong>Success!</strong> Finishing berhasil di update.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div id="error-alert" class="alert alert-danger alert-dismissible fade" role="alert">
            <strong>Error!</strong> Finishing gagal di update.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <form id="bulkUpdateForm">
        <table class="table ms-5" style="width: 90%">
            <thead>
                <tr class="table-primary">
                    <th scope="col">No</th>
                    <th scope="col">Material</th>
                    <th scope="col">Nama produk</th>
                    <th scope="col">Ukuran</th>
                    <th scope="col">Finishing</th>
                    <th scope="col">Harga modal</th>
                    <th scope="col">Harga jual</th>
                    <th scope="col">Jumlah stok</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $no = 1;
                $finishingOptions = [];
                $finishingQuery = "SELECT * FROM finishing";
                $finishingResult = mysqli_query($db, $finishingQuery);
                while ($finishingRow = mysqli_fetch_assoc($finishingResult)) {
                    $finishingOptions[] = $finishingRow;
                }

                $sql = "SELECT * FROM produk";
                $query = mysqli_query($db, $sql);

                while ($data = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td>".$no++."</td>";
                    echo "<td>".$data['material']."</td>";
                    echo "<td>".$data['nama_produk']."</td>";
                    echo "<td>".$data['ukuran']."</td>";
                    echo "<td>";
                    echo "<select class='form-select finishing-dropdown' data-id='".$data['id_produk']."' name='finishing[".$data['id_produk']."]'>";
                    foreach ($finishingOptions as $option) {
                        $selected = ($option['finishing'] == $data['finishing']) ? 'selected' : '';
                        echo "<option value='".$option['id_finishing']."' $selected>".$option['finishing']."</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                    echo "<td>".$data['harga_modal']."</td>";
                    echo "<td>".$data['harga_jual']."</td>";
                    echo "<td>".$data['jumlah_stok']."</td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-end me-5">
            <button type="button" id="bulkUpdateButton" class="btn btn-primary" hidden>Update All</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.finishing-dropdown').change(function() {
                var id_produk = $(this).data('id');
                var id_finishing = $(this).val();
                $.ajax({
                    url: 'update_finishing.php',
                    type: 'POST',
                    data: {id_produk: id_produk, id_finishing: id_finishing},
                    success: function(response) {
                        $('#success-alert').addClass('show');
                        setTimeout(function() {
                            $('#success-alert').removeClass('show');
                        }, 3000);
                    },
                    error: function() {
                        $('#error-alert').addClass('show');
                        setTimeout(function() {
                            $('#error-alert').removeClass('show');
                        }, 3000);
                    }
                });
            });

            $('#bulkUpdateButton').click(function() {
                $.ajax({
                    url: 'bulk_update_finishing.php',
                    type: 'POST',
                    data: $('#bulkUpdateForm').serialize(),
                    success: function(response) {
                        $('#success-alert').addClass('show');
                        setTimeout(function() {
                            $('#success-alert').removeClass('show');
                        }, 3000);
                    },
                    error: function() {
                        $('#error-alert').addClass('show');
                        setTimeout(function() {
                            $('#error-alert').removeClass('show');
                        }, 3000);
                    }
                });
            });
        });
    </script>
</body>
</html>