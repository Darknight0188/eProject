<?php
    $xtpr = new XTemplate('views/register/register.html');

    $do_save = 1;
        if($_POST){
        $name = $_POST['txtName'];
        $email = $_POST['txtMail'];
        $phone = $_POST['txtPhone'];
        $address = $_POST['txtAddress'];
        $password = MD5($_POST['txtPwd']);
        $repassword = MD5($_POST['re_password']);
        $dob = $_POST['txtDate'];
        $gender = $_POST['gender'];
        
        $arr['name'] = "'{$name}'";
        $arr['email'] = "'{$email}'";
        $arr['phone'] = "'{$phone}'";
        $arr['address']="'{$address}'";
        $arr['password'] = "'{$password}'";
        $arr['dob'] = "'{$dob}'";
        $arr['gender'] = "'{$gender}'";
       
        if($valid->isString($name) == 'NO'){
            $do_save=0;
            $erro_name = 'Full name is invalid!';
            $xtpr -> assign('erro_name',$erro_name);
        }
        

        if($valid->isPhone($phone) == 'NO'){
            $do_save = 0;
            $erro_phone = 'Phone is Invalid!';
            $xtpr->assign('erro_phone',$erro_phone);
        }
        
        if($password == ''){
            $do_save = 0;
            $erro_password = 'Enter your password';
            $xtpr->assign('erro_password',$erro_password);
        }

        if($password != $repassword){
            $do_save = 0;
            $erro_re_password = 'Password not match!';
            $xtpr->assign('erro_re_password',$erro_re_password);
        }
        
        if($valid->isEmail($email) == 'NO'){
            $do_save = 0;
            $erro_email = 'Email is Invalid!';
            $xtpr->assign('erro_email',$erro_email);
        }

        if($valid->isAddress($address) == 'NO'){
            $do_save = 0;
            $erro_address = 'Address is Invalid!';
            $xtpr->assign('erro_address',$erro_address);
        }

        if($dob == ''){
            $do_save = 0;
            $erro_date = 'Enter date of birth!';
            $xtpr->assign('erro_date',$erro_date);
        }

        if($db->checkExitst('users',"email={$email}")=='YES'){
			$do_save = 0;
			$xtpr->assign('erro_email','existed email');
        }

        if($do_save == 1){
            $db->insert('users',$arr);
            $f->redir('?m=home&a=home');
        }
    }


    $xtpr->parse('REGISTER');
    $content = $xtpr->text('REGISTER');