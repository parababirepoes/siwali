<?php

    require 'function.php';
    $nis = $_GET['id'];
    $siswa = query("SELECT NIS, absen, nama, alamat, telepon FROM siswa WHERE NIS = '$nis'");
    $nilai = query("SELECT n.id, m.namaMapel, n.NIS, n.kodeMapel, n.nilaiTugas, n.nilaiQuiz, n.nilaiUTS, n.nilaiUAS 
	    FROM nilai n LEFT JOIN matapelajaran m ON n.kodeMapel = m.kodeMapel
        WHERE n.NIS = '$nis' ORDER BY kodeMapel DESC;");
    $guru = readGuru();
    $kelas = $guru[0]['kodeKelas'];
    $namaGuru = $guru[0]['nama'];
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

        <title>rinciannilai</title>
    </head>
    <body>
        <!-- header -->
        <div class="container bg-light">
            <div class="header">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <div class="kelas container">
                            <div class="kode container">
                                <h1 class="navbar-brand" style="color: #2381B7;font-style: normal;font-weight: 900;font-size: 50px;line-height: 73px;display: flex;align-items: center;">Kelas <?=$kelas?></h1>
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
                <div class="namaGuru container">
                    <div class="nama container">
                        <h2 class="navbar-brand fs-5" style="color: #FFFFFs;">Selamat Datang <?=$namaGuru?></h2>
                    </div>
                </div>
                <div class="logout">
                    <div class="text-end">
                        <a href="index.php"><button type="button" class="btn btn-warning">Logout</button></a>
                    </div>
                </div>
                <ul class="nav nav-tabs mt-4">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="nilai.php">Kembali</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page">Rincian Data Siswa</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end header -->
        <!-- table -->
        <div class="container bg-white pt-5" style="height: 29em;">
            <form action="" method="POST" autocomplete="off">
                <div class="row">
                    <div class="col" style="max-width: 30em;">
                        <div class="edit pt-3" style="max-width:280px; margin:auto; font-size:small;">
                            <label class="sr-only" for="nama" >Nama Siswa </label>
                            <input class="form-control form-control-sm" type="text" name="nama" id="nama" value="<?= $siswa[0]['nama']?>" required disabled>
                            <label class="sr-only mt-3" for="absen" >Absen </label>
                            <input class="form-control form-control-sm" type="text" name="absen" id="nama" value="<?= $siswa[0]['absen']?>"required disabled>
                            <label class="sr-only mt-3" for="alamat" >Alamat</label>
                            <input class="form-control form-control-sm" type="text" name="alamat" id="alamat" value="<?= $siswa[0]['alamat']?>"required disabled>
                            <label class="sr-only mt-3" for="telepon" >Telepon</label>
                            <input class="form-control form-control-sm" type="text" name="telepon" id="telepon" value="<?= $siswa[0]['telepon']?>"required disabled>
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
                                    <tr>
                                        <td><input type="text" name="id<?=$count?>" value="<?=$eachnilai['id']?>" hidden><?= $eachnilai['namaMapel']?></td>
                                        <td><input class="form-control form-control-sm" type="text" name="tugas" value="<?= $eachnilai['nilaiTugas']?>" size="3" required disabled></td>
                                        <td><input class="form-control form-control-sm" type="text" name="quiz" value="<?= $eachnilai['nilaiQuiz']?>" size="3" required disabled></td>
                                        <td><input class="form-control form-control-sm" type="text" name="uts" value="<?= $eachnilai['nilaiUTS']?>" size="3" required disabled></td>
                                        <td><input class="form-control form-control-sm" type="text" name="uas" value="<?= $eachnilai['nilaiUAS']?>" size="3" required disabled></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
        <!-- end table -->
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
