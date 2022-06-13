<?php

    require 'function.php';

    $guru = readGuru();
    if($guru == NULL){
        $kelas = "";
        $namaGuru = "";
        if(isset($_POST["submit"])){
            if (createSiswa($_POST) == 1) {
                echo "
                    <script>
                        alert('Data Siswa Berhasil Ditambah!');
                        document.location.href = 'admin.php';
                    </script>
                ";
            }
        }
    } else {
        $kelas = $guru[0]['kodeKelas'];
        $namaGuru = $guru[0]['nama'];
        if(isset($_POST["submit"])){
            if (createSiswa($_POST) == 1) {
                echo "
                    <script>
                        alert('Data Siswa Berhasil Ditambah!');
                        document.location.href = 'home.php';
                    </script>
                ";
            }
        }
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

        <title>editdata</title>
    </head>
    <body>
        <div class="container bg-light pt-5 vh-100">
            <div class="row">
                <div class="col">
                    <div class="title text-center" style="padding-top:5em;"> 
                        <img src="asset/img/logosiwali.png" height="200em" alt="">
                    </div>
                </div>
                <div class="col">
                    <div class="form text-center ">
                        <form action="" method="POST" autocomplete="off" style="max-width: 300px;margin:auto" >
                            <img src="asset/img/logosma1.png" height ="100" alt="logoSMA" >
                            <h1 class="h3 mt-3 mb-2 font-wight-normal">Tambah Siswa</h1>
                            
                            <label class="sr-only" for="nama" ></label>
                            <input class="form-control form-control-sm" type="text" name="nama" id="nama" placeholder="Nama" required autofocus>
                            
                            <label class="sr-only" for="absen" ></label>
                            <input class="form-control form-control-sm" type="text" name="absen" id="absen" placeholder="Absen" required autofocus>
                            
                            <label class="sr-only" for="alamat" ></label>
                            <input class="form-control form-control-sm" type="text" name="alamat" id="alamat" placeholder="Alamat" required autofocus>

                            <label class="sr-only" for="telepon" ></label>
                            <input class="form-control form-control-sm" type="text" name="telepon" id="telepon" placeholder="No Telepon" required autofocus>

                            <?php if($kelas == ""): ?>
                                <select class="form-select form-select-sm mt-4" aria-label=".form-select-sm example" name="kodeKelas">
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
                            <?php else: ?>
                                <label class="sr-only" for="kodeKelas" ></label>
                                <input class="form-control form-control-sm" type="text" name="kodeKelas" id="kodeKelas" value="<?=$kelas?>" readonly required>
                            <?php endif ?>

                            <div class="mt-3 text-center">
                                <button class="btn btn-lg btn-primary btn-sm" name="submit">Tambah Siswa</button> 
                            </div>
                        </form>

                        <!-- Logic Back -->
                        <?php if ($admin == NULL):?>
                            <form action="home.php" autocomplete="off" style="max-width: 300px;margin:auto">
                                <div class="mt-3 text-start">
                                    <button class="btn btn-lg btn-danger btn-sm">Kembali</button> 
                                </div>
                            </form>
                        <?php else :?>
                            <form action="admin.php" autocomplete="off" style="max-width: 300px;margin:auto">
                                <div class="mt-3 text-start">
                                    <button class="btn btn-lg btn-danger btn-sm">Kembali</button> 
                                </div>
                            </form>
                        <?php endif ?>
                    </div>
                </div>
            </div>
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
