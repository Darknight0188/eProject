<?php
    $xtp = new XTemplate("views/login.html");
    //session_register('C1811L_SINGIN_SUCCESS_FULLNAME');
    if($_POST){
        $_SESSION['user_cus'] = '';
        $_SESSION['user_id'] = '';
        $email = $_POST['mail'];
        $pwd = $_POST['user_password'];
        $xtp->assign('name_users','hidden');
        $xtp->assign('logout','hidden');
        //1.validation
        //2.Login
        $pwd1 = md5($pwd);
        $sql= "SELECT * FROM users WHERE email='{$email}' AND password = '{$pwd1}' ";
        $rs = $db->fetchOne($sql);
        if(strlen($rs['email'])>0){
            $_SESSION['user_cus'] = $rs['name'];
            $_SESSION['user_id']  = $rs['id'];
        }
        if(isset($_SESSION['user_cus'])&&isset($_SESSION['user_id'])){
            $f->redir($baseUrl."?m=home&a=home");
        }
}


    $xtp->parse("LOGIN");
    $content = $xtp->text("LOGIN");