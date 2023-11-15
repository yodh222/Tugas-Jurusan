<?php
include '../conn.php';
$id = $_POST['id'];

mysqli_query($conn, "DELETE FROM mhs WHERE id_mhs='$id'");
header('Location: Admin');
