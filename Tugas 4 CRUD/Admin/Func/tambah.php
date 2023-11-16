<?php
include "../../Func/conn.php";
require_once '../../Func/function.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nilai_nim = $_POST['nim'];
    $nilai_nama = $_POST['nama'];
    $nilai_jenis_kelamin = $_POST['jenis_kelamin'];
    $nilai_jurusan = $_POST['jurusan'];
    $nilai_alamat = $_POST['alamat'];
    
    $query = "INSERT INTO mhs (nim, nama, jenis_kelamin, jurusan, alamat) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    
    mysqli_stmt_bind_param($stmt, "sssss", $nilai_nim, $nilai_nama, $nilai_jenis_kelamin, $nilai_jurusan, $nilai_alamat);
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: /');
}
?>