<?php
function base_url() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];

    return rtrim("$protocol://$host", '/');
}

function isUserLoggedIn() {
    return isset($_COOKIE['user']);
}

function isUserAdmin($conn,$username) {
    $query = "SELECT * FROM user WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);


    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row['role'] === 'admin';
    }

    return false;
}

function redirectIfNotLoggedIn() {
    if (!isUserLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

function encryptCookie($value, $key){
    $cipher = "AES-256-CBC";
    $options = 0;
    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($iv_length);
    $encrypted = openssl_encrypt($value, $cipher, $key, $options, $iv);
    return base64_encode($iv . $encrypted);
}

function decryptCookie($value, $key) {
    $cipher = "AES-256-CBC";
    $options = 0;
    $value = base64_decode($value);
    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = substr($value, 0, $iv_length);
    $encrypted = substr($value, $iv_length);
    return openssl_decrypt($encrypted, $cipher, $key, $options, $iv);
}

function checkCookie($conn,$url){
    $username = decryptCookie($_COOKIE['user'], "NgeriBang");

    if (isset($_COOKIE['user'])) {
        $username = decryptCookie($_COOKIE['user'], "NgeriBang");

        // Redirect sesuai rolenya
        if (isUserAdmin($conn, $username)) {
            header('Location: ' . $url . '/Admin');
            exit();
        } else {
            header('Location: ' . $url . '/User');
            exit();
        }
    }
}

function checkCookiePage($conn,$type){
    if(isset($_COOKIE['user'])){
        $username = decryptCookie($_COOKIE['user'], "NgeriBang");
        if ($type == "admin") {
            if (!isUserAdmin($conn,$username)) {
                header('Location: '.base_url().'/User');
            }
        }elseif ($type == "user") {
            if (isUserAdmin($conn,$username)) {
                header('Location: '.base_url().'/Admin');
            }
        }
    }else{
        header('Location: '.base_url().'/login.php');
    }
}
?>