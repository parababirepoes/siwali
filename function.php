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

function sortnilai($data){
    $sortby = $data['sortby'];
    $range1 = $data['range1'];
    $range2 = $data['range2'];
    $tipe = $data['tipe'];

    if ($tipe == 'DESC' || $tipe == NULL) {
        if(($range1 == NULL && $range2 == NULL) && $sortby != 'AVG'){
            $result = query("SELECT s.NIS, s.absen, s.nama  FROM siswa s 
                JOIN guru g ON s.kodeKelas = g.kodeKelas 
                JOIN login l ON g.NIP = l.NIP
                JOIN sumnilai sn ON s.NIS = sn.NIS
                WHERE sn.kodeMapel IN('$sortby')
                ORDER BY sn.AVG DESC");
            return $result;
        } else if(($range1 == NULL && $range2 == NULL) && $sortby == 'AVG') {
            $result = query("SELECT s.NIS, s.absen, s.nama  FROM siswa s 
                JOIN guru g ON s.kodeKelas = g.kodeKelas 
                JOIN login l ON g.NIP = l.NIP
                JOIN avgnilai an ON s.NIS = an.NIS
                ORDER BY an.AVGNilai DESC");
            return $result;
        } else if(($range1 != NULL || $range2 != NULL) && $sortby != 'AVG'){
            $result = query("SELECT s.NIS, s.absen, s.nama  FROM siswa s 
                JOIN guru g ON s.kodeKelas = g.kodeKelas 
                JOIN login l ON g.NIP = l.NIP
                JOIN sumnilai sn ON s.NIS = sn.NIS
                WHERE sn.AVG BETWEEN '$range1' AND '$range2'
                    AND sn.kodeMapel IN('$sortby')
                ORDER BY sn.AVG DESC");
            return $result;
        } else {
            $result = query("SELECT s.NIS, s.absen, s.nama  FROM siswa s 
                JOIN guru g ON s.kodeKelas = g.kodeKelas 
                JOIN login l ON g.NIP = l.NIP
                JOIN avgnilai an ON s.NIS = an.NIS
                WHERE an.AVGNilai BETWEEN '$range1' AND '$range2'
                ORDER BY an.AVGNilai DESC");
            return $result;
        }
    } else {
        if(($range1 == NULL && $range2 == NULL) && $sortby != 'AVG'){
            $result = query("SELECT s.NIS, s.absen, s.nama  FROM siswa s 
                JOIN guru g ON s.kodeKelas = g.kodeKelas 
                JOIN login l ON g.NIP = l.NIP
                JOIN sumnilai sn ON s.NIS = sn.NIS
                WHERE sn.kodeMapel IN('$sortby')
                ORDER BY sn.AVG ASC");
            return $result;
        } else if(($range1 == NULL && $range2 == NULL) && $sortby == 'AVG') {
            $result = query("SELECT s.NIS, s.absen, s.nama  FROM siswa s 
                JOIN guru g ON s.kodeKelas = g.kodeKelas 
                JOIN login l ON g.NIP = l.NIP
                JOIN avgnilai an ON s.NIS = an.NIS
                ORDER BY an.AVGNilai ASC");
            return $result;
        } else if(($range1 != NULL || $range2 != NULL) && $sortby != 'AVG'){
            $result = query("SELECT s.NIS, s.absen, s.nama  FROM siswa s 
                JOIN guru g ON s.kodeKelas = g.kodeKelas 
                JOIN login l ON g.NIP = l.NIP
                JOIN sumnilai sn ON s.NIS = sn.NIS
                WHERE sn.AVG BETWEEN '$range1' AND '$range2'
                    AND sn.kodeMapel IN('$sortby')
                ORDER BY sn.AVG ASC");
            return $result;
        } else {
            $result = query("SELECT s.NIS, s.absen, s.nama  FROM siswa s 
                JOIN guru g ON s.kodeKelas = g.kodeKelas 
                JOIN login l ON g.NIP = l.NIP
                JOIN avgnilai an ON s.NIS = an.NIS
                WHERE an.AVGNilai BETWEEN '$range1' AND '$range2'
                ORDER BY an.AVGNilai ASC");
            return $result;
        }
    }
}

function readMapel($kodeKelas){
    $mapel = query("SELECT m.kodeMapel FROM matapelajaran m 
        JOIN kelas k ON m.jurusan = k.jurusan
        WHERE k.kodeKelas = '$kodeKelas'");
    return $mapel;
}

function update($data)
{
    global $database;
    $NIS = $data['submit'];
    $absen = $data['absen'];
    $nama = $data['nama'];
    $id1 = $data['id1'];
    $tugas1 = $data["tugas1"];
    $quiz1 = $data["quiz1"];
    $uts1 = $data["uts1"];
    $uas1 = $data["uas1"];
    $id2 = $data['id2'];
    $tugas2 = $data["tugas2"];
    $quiz2 = $data["quiz2"];
    $uts2 = $data["uts2"];
    $uas2 = $data["uas2"];
    $id3 = $data['id3'];
    $tugas3 = $data["tugas3"];
    $quiz3 = $data["quiz3"];
    $uts3 = $data["uts3"];
    $uas3 = $data["uas3"];
    $id4 = $data['id4'];
    $tugas4 = $data["tugas4"];
    $quiz4 = $data["quiz4"];
    $uts4 = $data["uts4"];
    $uas4 = $data["uas4"];
    
    mysqli_query($database, "UPDATE siswa 
        SET absen = '$absen', nama = '$nama'
        WHERE NIS = $NIS");

    mysqli_query($database, "UPDATE nilai
        SET nilaiTugas = '$tugas1', nilaiQuiz = '$quiz1', nilaiUTS = '$uts1', nilaiUAS = '$uas1'
        WHERE id = '$id1'");
    
    mysqli_query($database, "UPDATE nilai
        SET nilaiTugas = '$tugas2', nilaiQuiz = '$quiz2', nilaiUTS = '$uts2', nilaiUAS = '$uas2'
        WHERE id = '$id2'");

    mysqli_query($database, "UPDATE nilai
        SET nilaiTugas = '$tugas3', nilaiQuiz = '$quiz3', nilaiUTS = '$uts3', nilaiUAS = '$uas3'
        WHERE id = '$id3'");
    
    mysqli_query($database, "UPDATE nilai
        SET nilaiTugas = '$tugas4', nilaiQuiz = '$quiz4', nilaiUTS = '$uts4', nilaiUAS = '$uas4'
        WHERE id = '$id4'");

    return 1;
}

function readNilai($NIS)
{
    $nilai = query("SELECT * FROM sumnilai WHERE NIS = '$NIS';");
    return $nilai;
}

function readAVG($NIS)
{
    $AVG = query("SELECT * FROM avgnilai WHERE NIS = '$NIS';");
    return $AVG;
}

function deleteGuru($nip){
    global $database;

    mysqli_query($database, "DELETE FROM guru WHERE NIP = '$nip'");

    return 1;
}

function admin(){
    $admin = query("SELECT * FROM admin_view;");
    return $admin;
}

function readNameAdmin($name){
    $find = query("SELECT * FROM admin_view WHERE nama LIKE '%$name%';");
    if($find == NULL){
        return 1;
    } else {
        return $find;
    }
}

function getCategory($id){
    if (readSiswaSingle($id) == NULL){
        return 1;
    } else {
        return 2;
    }
}

function updateGuru($data){
    global $database;

    $id = $data['id'];
    $in_NIP = $data['NIP'];
    $in_nama = $data['nama'];
    $in_kodeKelas = $data['kodeKelas'];
    $in_password = $data['password'];
    $in_validation = $data['validation'];
    $in_alamat = $data['alamat'];
    $in_telepon = $data['telepon'];

    $query = "UPDATE guru SET NIP = '$in_NIP', nama = '$in_nama', 
        kodeKelas = '$in_kodeKelas', password = '$in_password', 
        alamat = '$in_alamat', telepon = '$in_telepon'
        WHERE NIP = '$id'";

    if ($in_password == $in_validation) {
        mysqli_query($database, $query);
        return 1;
    } else {
        return 0;
    }
}


function readAdmin(){
    $admin = query("SELECT * FROM login WHERE NIP = 'admin'");
    return $admin;
}