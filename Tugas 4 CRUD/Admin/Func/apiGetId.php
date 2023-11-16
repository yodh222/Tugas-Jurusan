<?php
include "../../Func/conn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])){
    $id =  $_POST['id'];
    $query = "SELECT nim,nama,jenis_kelamin,jurusan,alamat FROM mhs WHERE id_mhs='$id'";
    $res = mysqli_query($conn,$query);
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = array_map('htmlspecialchars', $row);
    }
    $json_enc = json_encode($data);
    echo $json_enc;
}else{
    header('Location: /');
}