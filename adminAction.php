<?php

    require 'function.php';

    $id = $_GET['id'];
    $category = getCategory($id);
    if ($category == 1){
        $guru = readGuruSingle($id);
        $NIP = $guru[0]['NIP'];
        $nama = $guru[0]['nama'];
        $kodeKelas = $guru[0]['kodeKelas'];
        $alamat = $guru[0]['alamat'];
        $telepon = $guru[0]['telepon'];
        $password  = $guru[0]['password'];
        if(isset($_POST["submit"])){
            if (updateGuru($_POST) == 1) {
                echo "
                    <script>
                        alert('Data Guru Berhasil Diupdate');
                        document.location.href = 'admin.php';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Password tidak valid');
                    </script>
                ";
            }
        }
    } else {
        if(isset($_POST["submit"])){
            if (update($_POST) == 1) {
                echo "
                    <script>
                        alert('Update Berhasil');
                        document.location.href = 'admin.php';
                    </script>
                ";
            }
        }
        $siswa = readSiswaSingle($id);
        $siswa = query("SELECT NIS, absen, nama, alamat, telepon FROM 
            siswa WHERE NIS = '$id'");
        $nilai = query("SELECT n.id, m.namaMapel, n.NIS, n.kodeMapel, n.nilaiTugas, n.nilaiQuiz, n.nilaiUTS, n.nilaiUAS 
	    FROM nilai n LEFT JOIN matapelajaran m ON n.kodeMapel = m.kodeMapel
        WHERE n.NIS = '$id' ORDER BY kodeMapel DESC;");
        $count = 0;
    }

    $admin = readAdmin();

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
        <div class="container bg-light">
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
                <ul class="nav nav-tabs mt-4">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="admin.php">Kembali</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page">Edit Data</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end header -->

        <?php if($category == 1): ?>
            <div class="container bg-white" style="height: 24em;" >
                <div class="form text-center">
                    <form action="" method="POST" autocomplete="off" style="max-width: 600px;margin:auto" >
                        <div class="row g-2">
                            <div class="col-sm me-5">

                                <input type="text" name="id" value="<?=$id?>" hidden>

                                <label class="sr-only" for="NIP" ></label>
                                <input class="form-control form-control-sm" type="text" name="NIP" id="NIP" placeholder="NIP" value="<?= $NIP ?>" required autofocus>
            
                                <label class="sr-only" for="nama" ></label>
                                <input class="form-control form-control-sm" type="text" name="nama" id="nama" placeholder="Nama" value="<?= $nama ?>" required autofocus>
            
                                <label class="sr-only" for="alamat" ></label>
                                <input class="form-control form-control-sm" type="text" name="alamat" id="alamat" placeholder="Alamat" value="<?= $alamat ?>" required autofocus>
            
                                <label class="sr-only" for="telepon" ></label>
                                <input class="form-control form-control-sm" type="text" name="telepon" id="telepon" placeholder="No Telepon" value="<?= $telepon ?>" required autofocus>
                            </div>
                            <div class="col-sm">
                                <select class="form-select form-select-sm mt-4" aria-label=".form-select-sm example" name="kodeKelas">
                                    <option selected value="<?= $kodeKelas ?>">Default</option>
                                    <option value="MIPA1">MIPA1</option>
                                    <option value="MIPA2">MIPA2</option>
                                    <option value="MIPA3">MIPA3</option>
                                    <option value="IIS1">IIS1</option>
                                    <option value="IIS2">IIS2</option>
                                    <option value="IIS3">IIS3</option>
                                    <option value="IBB1">IBB1</option>
                                    <option value="IBB2">IBB2</option>
                                    <option value="IBB3">IBB3</option>
                                </select>
            
                                <label class="sr-only" for="password" ></label>
                                <input class="form-control form-control-sm" type="password" name="password" id="password" placeholder="password" value="<?= $password ?>" required autofocus>
            
                                <label class="sr-only" for="validation" ></label>
                                <input class="form-control form-control-sm" type="password" name="validation" id="validation" placeholder="Konfirmasi Password" value="<?= $password ?>" required autofocus>
            
                                <div class="mt-4 text-start">
                                    <button class="btn btn-lg btn-primary btn-sm" name="submit">Update</button> 
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <!-- table -->
            <div class="container bg-white pt-5" style="height: 29em;">
                <form action="" method="POST" autocomplete="off">
                    <div class="row">
                        <div class="col" style="max-width: 30em;">
                            <div class="edit pt-3" style="max-width:280px; margin:auto; font-size:small;">
                                <label class="sr-only" for="nama" >Nama Siswa </label>
                                <input class="form-control form-control-sm" type="text" name="nama" id="nama" value="<?= $siswa[0]['nama']?>" required>
                                <label class="sr-only mt-3" for="absen" >Absen </label>
                                <input class="form-control form-control-sm" type="text" name="absen" id="nama" value="<?= $siswa[0]['absen']?>"required>
                                <label class="sr-only mt-3" for="alamat" >Alamat</label>
                                <input class="form-control form-control-sm" type="text" name="alamat" id="alamat" value="<?= $siswa[0]['alamat']?>"required>
                                <label class="sr-only mt-3" for="telepon" >Telepon</label>
                                <input class="form-control form-control-sm" type="text" name="telepon" id="telepon" value="<?= $siswa[0]['telepon']?>"required>
                                <button class="btn btn-lg btn-primary btn-sm mt-5" type="submit" name="submit" value="<?= $siswa[0]['NIS']?>">Update</button> 
                            </div>
                        </div>
                        <div class="col">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">MATA PELAJARAN</th>
                                        <th scope="col">TUGAS</th>
                                        <th scope="col">QUIZ</th>
                                        <th scope="col">UTS</th>
                                        <th scope="col">UAS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($nilai as $eachnilai) : ?>
                                        <?php $count++; ?>
                                        <tr>
                                            <td><input type="text" name="id<?=$count?>" value="<?=$eachnilai['id']?>" hidden><?= $eachnilai['namaMapel']?></td>
                                            <td><input class="form-control form-control-sm" type="text" name="tugas<?=$count?>" value="<?= $eachnilai['nilaiTugas']?>" size="3" required></td>
                                            <td><input class="form-control form-control-sm" type="text" name="quiz<?=$count?>" value="<?= $eachnilai['nilaiQuiz']?>" size="3" required></td>
                                            <td><input class="form-control form-control-sm" type="text" name="uts<?=$count?>" value="<?= $eachnilai['nilaiUTS']?>" size="3" required></td>
                                            <td><input class="form-control form-control-sm" type="text" name="uas<?=$count?>" value="<?= $eachnilai['nilaiUAS']?>" size="3" required></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        <?php endif ?>

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