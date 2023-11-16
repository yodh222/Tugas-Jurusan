<?php
require_once "Func/function.php";
include "Func/conn.php";

if(isUserLoggedIn()){
    checkCookie($conn,base_url());
}else{
    header('Location: login.php');
    exit();
}
?>