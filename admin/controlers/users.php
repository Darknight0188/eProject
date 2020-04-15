<?php
    $xtpt = new XTemplate('views/users.html');
	$condition = ' 1=1 ';
	if(isset($_POST['btnDel'])){
		$ls = implode(',', $_POST['ck']);
		$sql = "DELETE FROM category WHERE id in ({$ls})";
		$db->execSQL($sql);
	}
	$rs = $db->fetchAll('users',$condition);
	$t = count($rs);
	$l = 3;
	$page = (isset($_GET['page']))?$_GET['page']:1;
	$offset = ($page - 1) * $l;
	$url = "a=users";
	$condition .= " LIMIT {$offset},{$l}";
	$rs = $db->fetchAll('users',$condition);
	$pagers = $f->paging($url,$t,$l,'',(isset($_GET['s']))?$_GET['s']:'');
    if(count($rs)>0){
		$i = 1;
		foreach($rs as $r){
			//print_r($r);
			$r['STT'] = $i;
			$xtpt->insert_loop("USERS.US",array('US'=>$r));
			$i++;
		}
	}

	$xtpt->assign('pagers',$pagers);
    $xtpt->parse('USERS');
    $content = $xtpt->text('USERS');