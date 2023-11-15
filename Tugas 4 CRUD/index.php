<?php
require_once "function.php";
include "conn.php";

if(isUserLoggedIn()){
    checkCookie($conn,base_url());
}else{
    header('Location: login.php');
    exit();
}
?>