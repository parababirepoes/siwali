<?php

require 'function.php';

logout();

if(isset($_POST["submit"])){
    if (login($_POST) == 1) {
        echo "
            <script>
                alert('Login Berhasil');
                document.location.href = 'home.php';
            </script>
        ";
    } else if (login($_POST) == 2) {
        echo "
            <script>
                alert('Login Admin Berhasil');
                document.location.href = 'admin.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Login Gagal !');
                document.location.href = 'index.php';
            </script>
        ";
    }
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

        <title>siwali</title>
    </head>
    <body style="background-color: lightcyan;">
        <div class="container bg-light vh-100">
            <div class="container" style="padding-top: 5em;padding-bottom:5em;">
                <div class="row g-2 text-center" style="margin-left: 14em;margin-right:14em;">
                    <div class="col">
                        <img src="asset/img/logosiwali.png" alt="logosiwali" height="200em">
                    </div>
                    <div class="col">
                        <img src="asset/img/logosma1.png" alt="logoSMA" height ="200em">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <form action="" method="POST" autocomplete="off" style="max-width: 280px;margin:auto" >
                    <h1 class="h3 font-wight-normal" style="color:slategray;font-style: normal;font-weight: 900;font-size: 30px;">LOGIN SIWALI</h1>
                    <label class="sr-only" for="NIP" ></label>
                    <input class="form-control form-control-sm" type="text" name="NIP" id="NIP" placeholder="NIP" required autofocus>
                    <label class="sr-only" for="password" ></label>
                    <input class="form-control form-control-sm" type="password" name="password" id="password" placeholder="password" required autofocus>
                    <div class="mt-3">
                        <button class="btn btn-lg btn-primary btn-sm" name="submit">Login</button> 
                    </div>
                    <div class="text-center mt-3">
                        <p>Belum Punya Akun ? <a href="createGuru.php">Register</a></p>
                    </div>
                </form>
            </div>
            <br><br><br><br>
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