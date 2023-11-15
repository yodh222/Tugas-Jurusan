<?php
include '../conn.php';
require_once '../function.php';
$id = $_POST['id'];
$query1 = "SELECT * FROM mhs WHERE id_mhs='$id'";
$res2 = mysqli_query($conn,$query1);
$mhs=mysqli_fetch_assoc($res2);
if(isset($_POST['submit'])){
    $iid=$_POST['id'];
    $nim=$_POST['nim'];
    $nama = $_POST['nama'];
    $jenis_kelamin=$_POST['jenis_kelamin'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];

    $query = "UPDATE mhs SET nim=?, nama=?, jenis_kelamin=?, jurusan=?, alamat=? WHERE id_mhs=?";
    $res1 = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($res1, "ssssss", $nim, $nama, $jenis_kelamin, $jurusan, $alamat, $iid);
    mysqli_stmt_execute($res1);

    // $query2 = "SELECT * FROM mhs WHERE id_mhs='$iid'";
    // $res3 = mysqli_query($conn, $query1);
    // $asd = mysqli_fetch_assoc($res2);

    // echo $asd;

    header('Location: '.base_url().'/Admin');
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ac8a45e20d.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-3">
        <h1 class="text-center">Edit Data</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?= $mhs['id_mhs']?>">
            <div class="mb-3">
                <label for="nim" class="form-label">Nim:</label>
                <input type="number" class="form-control" id="nim" name="nim" required value="<?= $mhs['nim'] ?>">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required value="<?= $mhs['nama'] ?>">
            </div>
            <div class="mb-3">
                <label for="jenisKelamin" class="form-label">Jenis Kelamin:</label>
                <select class="form-select" id="jenisKelamin" name="jenis_kelamin" required>
                    <option value="L" <?= $mhs['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="P" <?= $mhs['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan:</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" required value="<?= $mhs['jurusan'] ?>">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required value="<?= $mhs['alamat'] ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>