<?php
	if($_SESSION['admin'] != 1){
		$f->redir('?a=product');
	}else{
		$xtpt = new XTemplate('views/admin.html');
		$condition = ' 1=1 ';
		$rs = $db->fetchAll('admin',$condition);
		$t = count($rs);
		$l = 3;
		$page = (isset($_GET['page']))?$_GET['page']:1;
		$offset = ($page - 1) * $l;
		$url = "a=admin";
		$condition .= " LIMIT {$offset},{$l}";
		$rs = $db->fetchAll('admin',$condition);
		$pagers = $f->paging($url,$t,$l,'',(isset($_GET['s']))?$_GET['s']:'');
		if(count($rs)>0){
			$i = 1;
			foreach($rs as $r){
				//print_r($r);
				$r['STT'] = $i;
				$xtpt->insert_loop("ADMIN.AP",array('AP'=>$r));
				$i++;
			}
		}

		$xtpt->assign('pagers',$pagers);
		$xtpt->parse('ADMIN');
		$content = $xtpt->text('ADMIN');
	}