<?php   
    $xtpg = new XTemplate('views/cart.html');
    $condition = ' 1=1 ';
    $sql = "SELECT transaction.* , users.name as nameusers, users.phone as phoneuser FROM transaction LEFT JOIN users ON users.id = transaction.users_id ORDER BY ID DESC";
	$rs = $db->fetch($sql);
	$t = count($rs);
	$l = 5;
	$page = (isset($_GET['page']))?$_GET['page']:1;
	$offset = ($page - 1) * $l;
	$url = "a=cart";
	$condition .= " LIMIT {$offset},{$l}";
	$rs = $db->fetch($sql);
	$pagers = $f->paging($url,$t,$l,'',(isset($_GET['s']))?$_GET['s']:'');
    if(count($rs)>0){
		$i = 1;
		foreach($rs as $r){
			//print_r($r);
            $r['STT'] = $i;
            if($r['status'] == 0){
                $r['status'] = 'chưa xử lý';
                $xtpg->assign('btn','btn-danger');
            } else{
                $r['status'] = 'đã xử lý';
                $xtpg->assign('btn','btn-info');
            }
            $xtpg->insert_loop("CART_AD.US",array('US'=>$r));
			$i++;
		}
	}

	$xtpg->assign('pagers',$pagers);





    $xtpg->parse('CART_AD');
    $content = $xtpg->text('CART_AD');