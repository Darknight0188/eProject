<?php
    include("../libs/bootstrap.php");
    $xtp = new XTemplate("views/login.html");
    if($_POST){
        $_SESSION['user_email'] = '';
        $email = $_POST['txtEmail'];
        $pwd = $_POST['txtPassword'];
        $pwd1 = md5($pwd);
        $sql= "SELECT * FROM admin WHERE email='{$email}' AND password = '{$pwd1}' ";
        $rs = $db->fetchOne($sql);
        if(strlen($rs['email'])>0){
            $_SESSION['user_email'] = $rs['email'];
            $_SESSION['admin'] = $rs['level'];
            $_SESSION['user_name'] = $rs['name'];

            if(isset($_POST['ckRemember'])){
                setcookie("user_email", $rs['email'], time() + 30 * 24 * 60 * 60, "/eProject/admin/");
                setcookie("admin", $rs['level'], time() + 30 * 24 * 60 *60, "/eProject/admin/");
                setcookie("username", $rs['name'], time() + 30 * 24 * 60 *60, "/eProject/admin/");
            }
            $f->redir($baseUrl."admin/?a=product");
        }
        
    }


    $xtp->parse("LOGIN");
    $xtp->out("LOGIN");