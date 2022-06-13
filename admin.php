<?php
    require 'function.php';
    $delete = $_GET;
    if ($delete != NULL) {
        deleteSiswa($delete['id']);
        deleteGuru($delete['id']);
    }
    if(isset($_POST["find"])){
        $nama = $_POST["nama"];
        $data = readNameAdmin($nama);
        if ($data == 1){
            echo "
                <script>
                    alert('Data Tidak Ditemukan');
                    document.location.href = 'admin.php';
                </script>
            ";
            $admin = admin();
        } else {
            $admin = $data;  
        }
    } else {
        $admin = admin();
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Style CSS-->
    <link rel="stylesheet" href="style/header_style.css">

    <title>adminsiwali</title>
    </head>
    <body>
        <!-- header -->
        <div class="container bg-light pb-3">
            <div class="header">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <div class="kelas container">
                            <div class="kode container">
                                <h1 class="navbar-brand" style="color: #2381B7;font-style: normal;font-weight: 900;font-size: 50px;line-height: 73px;display: flex;align-items: center;">Selamat Datang Admin<br>SI WALI</h1>
                            </div>
                        </div>   
                        <div class="gambar1 navbar-brand" >
                            <img src="asset/img/logosiwali.png" alt="logosiwali" height="120em">
                        </div>
                        <div class="gambar2 navbar-brand" >
                            <img src="asset/img/logosma1.png" alt="logosiwali" height="120em">
                        </div>
                    </div>
                </nav>
                <div class="text-end">
                    <div class="pe-5">
                        <div class="mb-3">
                            <a href="index.php"><button type="button" class="btn btn-warning">Logout</button></a>
                        </div>
                        <div class="pt-3 d-inline">
                            <a href="createData.php"><button type="button" class="btn btn-success">Tambah Siswa</button></a>
                        </div>
                        <div class="pt-3 d-inline">
                            <a href="createGuru.php"><button type="button" class="btn btn-success">Tambah Guru</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <form class="form-inline" autocomplete="off" method="POST">
                <div class="row g-2">
                    <div class="col-sm-3">
                        <div class="form-group ms-5">
                            <input type="text" class="form-control" name="nama" id="find" placeholder="Nama">
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" name="find" class="btn btn-dark mb-2">Cari</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container vh-100 bg-white">
            <table class="table ms-5" style="max-width: 75em;">
                <thead>
                    <tr>
                        <th scope="col">Index</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($admin as $row) : ?>
                        <tr>
                            <td><?= $row["kodeUnik"] ?></td>
                            <td><?= $row["nama"] ?></td>
                            <td><?= $row["kodeKelas"] ?></td>
                            <td><?= $row["alamat"] ?></td>
                            <td><?= $row["telepon"] ?></td>
                            <td>
                                <div class="row g-2">
                                    <div class="col-sm-3">
                                        <a href="adminAction.php?id=<?= $row['kodeUnik']; ?>">
                                            <button type="button" class="btn-sm btn-primary">Edit</button>
                                        </a>
                                    </div>
                                    <div class="col-sm">
                                        <a href="admin.php?id=<?= $row['kodeUnik']; ?>">
                                            <button type="button" class="btn-sm btn-info ">Delete</button>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <!-- end header -->

        <!-- tabel semua data -->
        <!-- end tabel -->

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        -->
    </body>
</html>
