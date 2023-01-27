<?php
	session_start();
    //unset the id session
    if(!isset($_SESSION['login'])){
        header("Location: nohack.html");
    }else{
        unset($_SESSION['id']);
        session_destroy();
        header("Location: login.html");
} ?>