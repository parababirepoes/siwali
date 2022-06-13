<?php

//Koneksi ke database
$database = mysqli_connect("localhost", "root","", "siWali");

function query($query)
{
    global $database;
    $result = mysqli_query($database, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function login($data)
{
    global $database;
    $NIP_login = $data["NIP"];
    $pass_login = $data["password"];

    if ($NIP_login == 'admin' AND $pass_login = 'admin'){
        $query = "INSERT INTO login(NIP, password) VALUES
            ('$NIP_login', '$pass_login')";
        mysqli_query($database, $query);
        return 2;
    }
    $query = "SELECT * FROM guru WHERE 
            NIP IN('$NIP_login') AND password IN ('$pass_login')";

    $result = mysqli_query($database, $query);

    if (mysqli_num_rows($result) === 1) {
        $query = "INSERT INTO login(NIP, password) VALUES
            ('$NIP_login', '$pass_login')";

        mysqli_query($database, $query);

        return 1;
    } else {
        return 0;
    }
}

function logout()
{
    global $database;

    mysqli_query($database, "DELETE FROM login WHERE 1");

    return 1;
}

function createSiswa($data){
    global $database;
    $in_absen = $data['absen'];
    $in_nama = $data['nama'];
    $in_kodeKelas = $data['kodeKelas'];
    $in_alamat = $data['alamat'];
    $in_telepon = $data['telepon'];

    $query = "INSERT INTO siswa(absen, nama, kodeKelas, alamat, telepon) VALUES
        ('$in_absen', '$in_nama', '$in_kodeKelas', '$in_alamat', '$in_telepon')";

    if (mysqli_query($database, $query)) {
        return 1;
    } else {
        return 0;
    }
}

function createGuru($data){
    global $database;

    $in_NIP = $data['NIP'];
    $in_nama = $data['nama'];
    $in_kodeKelas = $data['kodeKelas'];
    $in_password = $data['password'];
    $in_validation = $data['validation'];
    $in_alamat = $data['alamat'];
    $in_telepon = $data['telepon'];

    $query = "INSERT INTO guru(NIP, nama, kodeKelas, password, alamat, telepon) VALUES
        ('$in_NIP', '$in_nama', '$in_kodeKelas', '$in_password', '$in_alamat', '$in_telepon')";

    if ($in_password == $in_validation) {
        mysqli_query($database, $query);
        return 1;
    } else {
        return 0;
    }
}

function readSiswa()
{
    $siswa = query("SELECT s.NIS, s.absen, s.nama, s.alamat, s.telepon FROM siswa s 
        JOIN guru g ON s.kodeKelas = g.kodeKelas JOIN login l ON g.NIP = l.NIP");
    return $siswa;
}

function readSiswaSingle($id)
{
    $siswa = query("SELECT * FROM siswa WHERE NIS = '$id';");
    return $siswa;
}

function deleteSiswa($nis)
{
    global $database;

    mysqli_query($database, "DELETE FROM siswa WHERE NIS = '$nis'");

    return 1;
}

function readGuru()
{
    $guru = query("SELECT * FROM guru g JOIN login l ON g.NIP = l.NIP");
    return $guru;
}

function readGuruSingle($id)
{
    $guru = query("SELECT * FROM guru WHERE NIP = '$id'");
    return $guru;
}

