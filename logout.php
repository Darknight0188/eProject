<?php
    include("libs/bootstrap.php");
    session_unset();
    $_SESSION = array();
    session_destroy($_SESSION['user_cus']);
    $f->redir($baseUrl."?m=home&a=home");