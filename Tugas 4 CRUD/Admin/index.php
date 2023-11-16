<?php
require_once "../Func/function.php";
include "../Func/conn.php";

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
    <link rel="shortcut icon" href="Assets/img/favicon.ico" type="image/x-icon">
</head>

<body>
    <!-- Content -->
    <h1 class="text-center">Sistem Informasi Mahasiswa</h1>
    <nav class="navbar navbar-expand-lg bg-primary text-light">
        <div class="container-fluid d-flex justify-content-between">
            <a class="navbar-brand text-light" href="/">Admin</a>
            <form class="d-flex">
                <button id="logout" class="btn btn-danger my-2 my-sm-0" type="submit" onclick="deleteCookie()">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5 mb-5">
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
                        <td>
                            <button type="submit" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editData" id="editButton" onclick="getData(<?= $mhs['id_mhs'] ?>)"><i class="fa-regular fa-pen-to-square"></i></button>
                            <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteVerif" id="deleteButton" onclick="deleteVerif(<?= $mhs['id_mhs'] ?>)"><i class="fa-solid fa-trash"></i></button>

                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="Admin/Func/tambah.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nim" class="form-label">Nim:</label>
                            <input type="number" class="form-control" name="nim" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama:</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenisKelamin" class="form-label">Jenis Kelamin:</label>
                            <select class="form-select" name="jenis_kelamin" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan:</label>
                            <input type="text" class="form-control" name="jurusan" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat:</label>
                            <input type="text" class="form-control" name="alamat" required>
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


    <div class="modal fade" id="editData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="Admin/Func/edit.php">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="nim" class="form-label">Nim:</label>
                            <input type="number" class="form-control" id="nim" name="nim" required>
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
                            <label for="jurusan" class="form-label">Jurusan:</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat:</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteVerif" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yaking ingin menghapus data?</p>
                </div>
                <div class="modal-footer">
                    <form action="Admin/Func/delete.php" method="post">
                        <input type="hidden" name="id" id="delID">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="bg-primary text-light text-center py-2">
        <div class="container">
            <p>&copy; 2023 Awikwok</p>
        </div>
    </footer>

    <!-- Script Section -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

    <script>
        function getData(id) {
            $.ajax({
                type: 'POST',
                url: 'Admin/Func/apiGetId.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    var nim = $('<div/>').text(data[0].nim).html();
                    var nama = $('<div/>').text(data[0].nama).html();
                    var jenisKelamin = $('<div/>').text(data[0].jenis_kelamin).html();
                    var jurusan = $('<div/>').text(data[0].jurusan).html();
                    var alamat = $('<div/>').text(data[0].alamat).html();

                    $('#nim').val(nim);
                    $('#nama').val(nama);
                    $('#jenisKelamin').val(jenisKelamin);
                    $('#jurusan').val(jurusan);
                    $('#alamat').val(alamat);
                    $('#id').val(id);
                },
                error: function() {
                    console.error('Gagal mengambil data.');
                }
            });
        }

        function deleteVerif(id) {
            $('#delID').val(id);
        }

        function deleteCookie() {
            $.cookie("user", '', {
                path: '/'
            });
        }
    </script>

</body>

</html>