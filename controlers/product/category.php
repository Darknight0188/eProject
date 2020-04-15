<?php
	$xtps = new XTemplate("views/home/category.html");
	$category_id = (isset($_GET['id']))?$_GET['id']:'';
	$temp = $_GET['temp'];
	$condition = ($category_id == '')?"temp_id=$temp":"category_id=$category_id and temp_id=$temp";
	function price($price){
        $price = number_format($price, 2, ',', '.');
        $split = explode(',', $price);
        if($split[1] == '00') $price = str_replace(',00', '', $price);
		return $price;
	}
	$rs = $db->fetchAll('product',$condition);
	if($category_id != ''){
		$brand = $db->fetch("SELECT * FROM category WHERE id = {$category_id}");
		$brand = $brand[0]['name'];
	}
	$cat_name = $db->fetch("SELECT * FROM temp WHERE id = {$temp}");
	$cat_name = $cat_name[0]['name'];
	$title = (isset($brand))?$cat_name.": ".$brand:$cat_name;
	$xtph->assign('title', $title);
    if(count($rs)>0){
		foreach($rs as $r){
			if($r['sale'] > 0){
                $r['sale'] = $r['price'] - ($r['price'] * $r['sale'])/100;
				$r['sale'] = price($r['sale']);
				$r['price'] = price($r['price']);
				$xtps->assign('show','');
            } else{
				$r['sale'] = $r['price'];
				$r['price'] = price($r['price']);
				$r['sale'] = price($r['sale']);
				$xtps->assign('show','hidden');
            }
			$xtps->insert_loop("CAT.LS",array('LS'=>$r));
		}
	}

	$temp = $db->fetchAll('temp'," 1=1 ");
	if(count($temp)>0){
		foreach($temp as $t){
			//get id of temp
			$type = $t['id'];
			//get all cats from that temp to count
			$cat = $db->fetch("SELECT * FROM category WHERE product_range LIKE '%{$type}%' ORDER BY name");
			$count = count($cat);
			//get first 5 cats from db to insert to first div column
			$cat1 = $db->fetch("SELECT * FROM category WHERE product_range LIKE '%{$type}%' ORDER BY name LIMIT 0, 5");
			foreach($cat1 as $r){
				$r['temp_id'] = $type;
				$xtps->insert_loop('CAT.DROP.CAT1', array('CAT1'=>$r));
			}
			//if number of cat > 5 and <= 10, get those cats from db to insert to 2nd div column
			if($count > 5){
				$cat2 = $db->fetch("SELECT * FROM category WHERE product_range LIKE '%{$type}%' ORDER BY name LIMIT 5, 10");
				foreach($cat2 as $r){
					$r['temp_id'] = $type;
					$xtps->insert_loop('CAT.DROP.CAT2', array('CAT2'=>$r));
				}
			}
			//if number of cat > 10 and <= 15, get cat (5-9) from db, insert to 2nd col, get the last cats and insert to 3rd col
			if($count > 10){
				$cat3 = $db->fetch("SELECT * FROM category WHERE product_range LIKE '%{$type}%' ORDER BY name LIMIT 10, 15");
				foreach($cat3 as $r){
					$r['temp_id'] = $type;
					$xtps->insert_loop('CAT.DROP.CAT3', array('CAT3'=>$r));
				}
			}
			//insert DROP block last, insert CAT block first
			$xtps->insert_loop("CAT.DROP",array('DROP'=>$t));
		}
	}
	$xtps->parse('CAT');
    $content = $xtps->text("CAT");