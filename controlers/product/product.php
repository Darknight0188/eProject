<?php
    $xtpl = new XTemplate("views/Products/products.html");

    function price($price){
        $price = number_format($price, 2, ',', '.');
        $split = explode(',', $price);
        if($split[1] == '00') $price = str_replace(',00', '', $price);
        return $price;
    }
    $condition = '1=1';
    $rs = $db->fetchAll('product',$condition);
    $t = count($rs);
	$l = 10;
	$page = (isset($_GET['page']))?$_GET['page']:1;
	$offset = ($page - 1) * $l;
	$url = "m=product&a=product";
	$condition .= " LIMIT {$offset},{$l}";
	$rs = $db->fetchAll('product',$condition);
	$pagers = $f->paging($url,$t,$l,'',(isset($_GET['s']))?$_GET['s']:'');
    if(count($rs)>0){
		foreach($rs as $r){
            if($r['sale'] > 0){
                $r['sale'] = $r['price'] - ($r['price'] * $r['sale'])/100;
				$r['sale'] = price($r['sale']);
				$r['price'] = price($r['price']);
				$xtpl->assign('show','');
            } else{
				$r['sale'] = $r['price'];
				$r['price'] = price($r['price']);
				$r['sale'] = price($r['sale']);
				$xtpl->assign('show','hidden');
            }
			$xtpl->insert_loop("PRODUCT.LS",array('LS'=>$r));
		}
	}


    $xtpl->assign('pagers',$pagers);
    $xtpl->parse('PRODUCT');
    $content = $xtpl->text('PRODUCT');