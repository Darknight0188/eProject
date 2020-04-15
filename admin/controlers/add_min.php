<?php
    if($_SESSION['admin'] != 1){
		$f->redir('?a=product');
	}else{
        $xtpa = new XTemplate('views/add_min.html');
        $condition = '1=1';
        
        $do_save = 1;
        if($_POST){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $password = MD5($_POST['password']);
            $repassword = MD5($_POST['re_password']);
            $level = $_POST['level'];
            
            $arr['name'] = "'{$name}'";
            $arr['email'] = "'{$email}'";
            $arr['phone'] = "'{$phone}'";
            $arr['address']="'{$address}'";
            $arr['password'] = "'{$password}'";
            $arr['level'] = "'{$level}'";
        
            if($valid->isString($name) == 'NO'){
                $do_save=0;
                $erro_name = 'Full name is invalid!';
                $xtpa -> assign('erro_name',$erro_name);
            }
            

            if($valid->isPhone($phone) == 'NO'){
                $do_save = 0;
                $erro_phone = 'Phone is Invalid!';
                $xtpa->assign('erro_phone',$erro_phone);
            }
            
            if($password == ''){
                $do_save = 0;
                $erro_password = 'Enter your password';
                $xtpa->assign('erro_password',$erro_password);
            }

            if($password != $repassword){
                $do_save = 0;
                $erro_re_password = 'Password not match!';
                $xtpa->assign('erro_re_password',$erro_re_password);
            }
            
            if($valid->isEmail($email) == 'NO'){
                $do_save = 0;
                $erro_email = 'Email is Invalid!';
                $xtpa->assign('erro_email',$erro_email);
            }

            if($valid->isAddress($address) == 'NO'){
                $do_save = 0;
                $erro_address = 'Address is Invalid!';
                $xtpa->assign('erro_address',$erro_address);
            }

            if($db->checkExitst('users',"email={$email}")=='YES'){
                $do_save = 0;
                $xtpa->assign('erro_email','existed email');
            }

            if($do_save == 1){
                $db->insert('admin',$arr);
                $f->redir('?a=admin');
            }
        }
        $xtpa->parse('PRO');
        $content = $xtpa->text('PRO');
    }