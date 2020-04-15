<?php
	include("libs/bootstrap.php");
	$xtph =  new XTemplate("views/index.html");
	$m = (isset($_GET['m']))?$_GET['m']:'home';
	$a = (isset($_GET['a']))?$_GET['a']:'home';
	//Kiem tra su ton tai cua action $a trong module $mail
	if(!isset($_SESSION['user_cus'])){
		if($m!=''&&$a!=''){
			if(file_exists("controlers/{$m}/{$a}.php")){
				include("controlers/{$m}/{$a}.php");
			}else{
				$content = "404 Not found!";
			}
			$xtph->assign('content',$content);
			$xtph->assign('name_users','hidden');
			$xtph->assign('logout','hidden');
			$xtph->assign('login','');
			$xtph->assign('register','');
		}
	}else{
		if($m!=''&&$a!=''){
			if(file_exists("controlers/{$m}/{$a}.php")){
				include("controlers/{$m}/{$a}.php");
			}else{
				$content = "404 Not found!";
			}
			$xtph->assign('content',$content);
			$xtph->assign('name_users','');
			$xtph->assign('logout','');
			$xtph->assign('login','hidden');
			$xtph->assign('register','hidden');
			$xtph->assign('users',$_SESSION['user_cus']);
		}
	}	



	$xtph->assign("baseUrl",$baseUrl);
	$xtph->parse('LAYOUT');
	$xtph->out('LAYOUT');