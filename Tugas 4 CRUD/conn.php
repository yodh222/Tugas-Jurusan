<?php
$conn=mysqli_connect("localhost","root","","mahasiswa");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>