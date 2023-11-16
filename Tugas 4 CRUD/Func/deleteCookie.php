<?php
$cookieName = 'user';

// Set waktu kedaluwarsa ke masa lalu untuk menghapus cookie
setcookie($cookieName, '', time() - 3600, '/');

// Contoh: Redirect ke halaman login
header('Location: login.php');
exit();
