<?php
	$xtpg = new XTemplate("views/details/details.html");
	function price($price){
        $price = number_format($price, 2, ',', '.');
        $split = explode(',', $price);
        if($split[1] == '00') $price = str_replace(',00', '', $price);
        return $price;
	}
	$id = $_GET['id'];
	$condition = '1=1';
	$sql = "SELECT product.*,category.name as categoryname FROM product LEFT JOIN category ON product.category_id = category.id WHERE product.id = $id";
	$rs = $db->fetch($sql);
    if(count($rs)>0){
		foreach($rs as $item){
			if($item['sale'] > 0){
                $item['sale'] = $item['price'] - ($item['price'] * $item['sale'])/100;
				$item['sale'] = price($item['sale']);
				$item['price'] = price($item['price']);
				$xtpg->assign('show','');
            } else{
				$item['sale'] = $item['price'];
				$item['price'] = price($item['price']);
				$item['sale'] = price($item['sale']);
				$xtpg->assign('show','hidden');
			}
			$xtpg->insert_loop("DETAILS.DT",array('DT'=>$item));
		}
	}






	$xtpg->parse("DETAILS");
    $content = $xtpg->text("DETAILS");