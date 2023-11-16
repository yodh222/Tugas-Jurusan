<?php
include '../../Func/conn.php';
require_once '../../Func/function.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nim=$_POST['nim'];
    $nama = $_POST['nama'];
    $jenis_kelamin=$_POST['jenis_kelamin'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];

    $query = "UPDATE mhs SET nim=?, nama=?, jenis_kelamin=?, jurusan=?, alamat=? WHERE id_mhs=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $nim, $nama, $jenis_kelamin, $jurusan, $alamat, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header('Location: /');
}
?>