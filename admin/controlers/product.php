<?php
    $xtpt = new XTemplate('views/product.html');
	$condition = ' 1=1 ';
	if(isset($_POST['btnDel'])){
		$ls = implode(', ',$_POST['ck']);
		$sql = "DELETE FROM product WHERE id IN ({$ls})";
		$db->execSQL($sql);
	}
	if($_POST){
		$keyword = $_POST['txtkeyword'];
		if(strlen($keyword)>0){
			$kw = strtolower($keyword);
			$kw = str_replace('','%',$kw);
			$condition .= "AND (LOWER(name) LIKE '%{$kw}%')";
		}
	}
	$rs = $db->fetchAll('product',$condition);
	$t = count($rs);
	$l = 5;
	$page = (isset($_GET['page']))?$_GET['page']:1;
	$offset = ($page - 1) * $l;
	$url = "a=product";
	$condition .= " LIMIT {$offset},{$l}";
	$rs = $db->fetchAll('product',$condition);
	$pagers = $f->paging($url,$t,$l,'',(isset($_GET['s']))?$_GET['s']:'');
    if(count($rs)>0){
		$i = 1;
		foreach($rs as $r){
			//print_r($r);
			$r['STT'] = $i;
			$xtpt->insert_loop("LIST.LP",array('LP'=>$r));
			$i++;
		}
	}

	$xtpt->assign('pagers',$pagers);
    $xtpt->parse('LIST');
    $content = $xtpt->text('LIST');