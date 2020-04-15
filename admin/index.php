<?php
    include("../libs/bootstrap.php");
    $xtph = new XTemplate('views/index.html');
    if(strlen($_SESSION['user_email'])>0){
        if($_SESSION['admin'] != 1) $xtph->assign('hidden', 'hidden');
        $a = (isset($_GET['a']))?$_GET['a']:'';
        if($a!=''){
			if(file_exists("controlers/{$a}.php")){
				include("controlers/{$a}.php");
			}else{
				$content = "404 Not found!";
			}
            $xtph->assign('content',$content);
            $xtph->assign('username','Welcome '.$_SESSION['user_email']);
        }
    }else{
        $f->redir($baseUrl."admin/login.php");
    }    
    $xtph->parse('LAYOUT');
    $xtph->out("LAYOUT");