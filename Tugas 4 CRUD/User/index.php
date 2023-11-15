<?php
require_once "../function.php";
include "../conn.php";

checkCookiePage($conn, "user");

$query = mysqli_query($conn, "SELECT * FROM mhs");
if (!$query) {
    die("Query error: " . mysqli_error($conn));
}

$res = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ac8a45e20d.js" crossorigin="anonymous"></script>
</head>

<body>
    <h1 class="text-center">Sistem Informasi Mahasiswa</h1>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid d-flex justify-content-between">
            <a class="navbar-brand" href="#">User</a>
            <form class="d-flex">
                <button id="logout" class="btn btn-danger my-2 my-sm-0" type="submit" onclick="logout()">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-3">
        <table class="table table-light table-striped">
            <thead>
                <tr>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Alamat</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                foreach ($res as $mhs) :
                ?>
                    <tr>
                        <td><?= htmlspecialchars($mhs['nim']) ?></td>
                        <td><?= htmlspecialchars($mhs['nama']) ?></td>
                        <td><?= $mhs['jenis_kelamin'] == "L" ? "Laki-laki" : "Perempuan" ?></td>
                        <td><?= htmlspecialchars($mhs['jurusan']) ?></td>
                        <td><?= htmlspecialchars($mhs['alamat']) ?></td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        document.getElementById('logout').addEventListener('click', function() {
            fetch('../deleteCookie.php', {
                    method: 'POST',
                })
                .then(response => {
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
</body>

</html>