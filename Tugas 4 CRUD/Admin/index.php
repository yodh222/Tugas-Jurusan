<?php
require_once "../function.php";
include "../conn.php";

checkCookiePage($conn, "admin");

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
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ac8a45e20d.js" crossorigin="anonymous"></script>
</head>

<body>
    <h1 class="text-center">Sistem Informasi Mahasiswa</h1>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid d-flex justify-content-between">
            <a class="navbar-brand" href="#">Admin</a>
            <form class="d-flex">
                <button id="logout" class="btn btn-danger my-2 my-sm-0" type="submit">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahData">
                Tambah Data
            </button>
        </div>

        <table class="table table-light table-striped">
            <thead>
                <tr>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
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
                        <td class="d-flex">
                            <form action="Admin/edit.php" method="post" class="me-2">
                                <input type="hidden" name="id" value="<?= $mhs['id_mhs'] ?>">
                                <button type="submit" class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></button>
                            </form>
                            <form action="Admin/delete.php" method="post" class="me-2">
                                <input type="hidden" name="id" value="<?= $mhs['id_mhs'] ?>">
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>

                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="tambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="Admin/edit.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nim:</label>
                            <input type="number" class="form-control" id="nama" name="nim" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenisKelamin" class="form-label">Jenis Kelamin:</label>
                            <select class="form-select" id="jenisKelamin" name="jenis_kelamin" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Jurusan:</label>
                            <input type="text" class="form-control" id="nama" name="jurusan" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Alamat:</label>
                            <input type="text" class="form-control" id="nama" name="alamat" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        document.getElementById('logout').addEventListener('click', function() {
            // Panggil skrip PHP untuk menghapus cookie saat tombol Logout ditekan
            fetch('../deleteCookie.php', {
                    method: 'POST',
                })
                .then(response => {
                    // Misalnya, muat ulang halaman setelah menghapus cookie
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
</body>

</html>