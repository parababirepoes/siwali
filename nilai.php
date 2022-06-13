<?php

    require 'function.php';

    if(isset($_POST["sort"]) && $_POST["sortby"] != NULL){
        $siswa = sortnilai($_POST);
        if($siswa == null){
            $siswa = 1;
        }
    } else {
        $siswa = query("SELECT s.NIS, s.absen, s.nama  FROM siswa s 
            JOIN guru g ON s.kodeKelas = g.kodeKelas JOIN login l ON g.NIP = l.NIP
            ORDER BY s.NIS");
    }

    $guru = query("SELECT * FROM guru g JOIN login l ON g.NIP = l.NIP");
    $kelas = $guru[0]['kodeKelas'];
    $namaGuru = $guru[0]['nama'];
    $mapel = readMapel($kelas);

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

    <title>nilai</title>
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
                    <a class="nav-link " aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="nilai.php">Nilai</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- end header -->
    
    <div class="container bg-white vh-100">
         <!-- table or NULL -->
        <?php if($siswa != NULL && $siswa != 1):?>
            <div class="text-end pt-3">
                <a href="createData.php"><button type="button" class="btn btn-success">Tambah Siswa</button></a>
            </div>

            <!-- sort -->
            <div class="container pb-4">
                <form action="" method="POST">

                    <!-- sortby -->
                    <select class="form-select btn-sm d-inline" name="sortby" size="1" aria-label="size 3 select example" style="max-width: 100px">
                        <option value="">SortBy</option>
                        <?php foreach($mapel as $eachmapel): ?>
                            <option value="<?=$eachmapel['kodeMapel']?>"><?=$eachmapel['kodeMapel']?></option>
                        <?php endforeach ?>
                        <option value="AVG">AVG</option>
                    </select>

                    <!-- range -->
                    <label class="sr-only d-inline" for="range1" ></label>
                    <input class="form-control form-control-sm d-inline ms-2" style="max-width: 4em;" type="text" name="range1" id="range1" placeholder="Range " >
                    <label class="sr-only d-inline" for="range2" ></label>
                    <input class="form-control form-control-sm d-inline ms-2" style="max-width: 4em;" type="text" name="range2" id="range2" placeholder="To" >
                    
                    <!-- button -->
                    <button type="submit" class="btn-sm btn-dark b-inline ms-2" name="sort">Sort</button>

                    <!-- tipe -->
                    <div class="radio mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipe" id="desc" value="DESC" checked>
                            <label class="form-check-label" for="desc">DESC</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipe" id="asc" value="ASC">
                            <label class="form-check-label" for="asc">ASC</label>
                        </div>
                    </div>
                    <!-- end -->
                </form>
            </div>
            <!-- end sort -->

            <!-- table -->
            <table class="table" style="margin-left:2em;max-width: 75em;">
                <thead>
                    <tr>
                        <th scope="col">Absen</th>
                        <th scope="col" class="col-lg-4">Nama</th>
                        <?php foreach($mapel as $eachmapel):?>
                            <th scope="col"><?=$eachmapel['kodeMapel']?></th>
                        <?php endforeach ?>
                        <th scope="col">AVG</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($siswa as $row) : ?>
                        <?php 
                            $nilai = readNilai($row['NIS']);
                            $avg = readAVG($row['NIS']);
                        ?>
                        <tr>
                            <th scope="row"><?=$row["absen"]?></th>
                            <td><?= $row["nama"] ?></td>

                            <?php foreach($nilai as $eachnilai):?>
                                <td><?=$eachnilai["AVG"]?></td>
                            <?php endforeach ?>

                            <td><?= $avg[0]["AVGNilai"] ?></td>
                            <td>
                                <div class="row g-2">
                                    <div class="col-sm-3">
                                        <a href="editData.php?id=<?= $row['NIS']; ?>">
                                            <button type="button" class="btn-sm btn-primary">Edit</button>
                                        </a>
                                    </div>
                                    <div class="col-sm">
                                        <a href="rincianNilai.php?id=<?= $row['NIS']; ?>">
                                            <button type="button" class="btn-sm btn-info ">Rincian</button>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- end table -->
        <?php elseif($siswa ==1):?> 
            <div class="text-end pt-3">
                <a href="createData.php"><button type="button" class="btn btn-success">Tambah Siswa</button></a>
            </div>
            <div class="d-flex align-items-center justify-content-center pt-5">
                <div class="text-center">
                    <h1 class="display-1 fw-bold fs-3">Data Tidak Ditemukan</h1>
                    <br><br>
                </div>
            </div>
        <?php else:?>
            <div class="d-flex align-items-center justify-content-center pt-5">
                <div class="text-center">
                    <h1 class="display-1 fw-bold fs-3">Data Masih Kosong</h1>
                    <br><br>
                    <a href="createData.php"><button type="button" class="btn btn-success">Tambah Siswa</button></a>
                </div>
            </div>
        <?php endif?>
        <!-- end table -->
    </div>

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
