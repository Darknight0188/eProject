<?php
    include("../libs/bootstrap.php");
    $_SESSION['user_email'] ='';
    session_destroy($_SESSION['user_email']);
    if(strlen($_SESSION['user_email']) == ''){
        $f->redir($baseUrl."admin/login.php");
    }