<?php
	$xtpl = new XTemplate("views/home/home.html");
   
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
	$page = (isset($_GET['s']))?$_GET['s']:1;
	$offset = ($page - 1) * $l;
	$url = "m=home&a=home";
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
			$xtpl->insert_loop("HOME.LS",array('LS'=>$r));
		}
	}

	$sql="SELECT * FROM product ORDER BY id DESC LIMIT 5 ";
	$rh = $db->fetch($sql);
	if(count($rh)>0){
		foreach($rh as $item){
			if($item['sale'] > 0){
                $item['sale'] = $item['price'] - ($item['price'] * $item['sale'])/100;
				$item['sale'] = price($item['sale']);
				$item['price'] = price($item['price']);
				$xtpl->assign('show','');
            } else{
				$item['sale'] = $item['price'];
				$item['price'] = price($item['price']);
				$item['sale'] = price($item['sale']);
				$xtpl->assign('show','hidden');
            }
			$xtpl->insert_loop("HOME.HOT",array('HOT'=>$item));
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
				$xtpl->insert_loop('HOME.DROP.CAT1', array('CAT1'=>$r));
			}
			//if number of cat > 5 and <= 10, get those cats from db to insert to 2nd div column
			if($count > 5){
				$cat2 = $db->fetch("SELECT * FROM category WHERE product_range LIKE '%{$type}%' ORDER BY name LIMIT 5, 10");
				foreach($cat2 as $r){
					$r['temp_id'] = $type;
					$xtpl->insert_loop('HOME.DROP.CAT2', array('CAT2'=>$r));
				}
			}
			//if number of cat > 10 and <= 15, get cat (5-9) from db, insert to 2nd col, get the last cats and insert to 3rd col
			if($count > 10){
				$cat3 = $db->fetch("SELECT * FROM category WHERE product_range LIKE '%{$type}%' ORDER BY name LIMIT 10, 15");
				foreach($cat3 as $r){
					$r['temp_id'] = $type;
					$xtpl->insert_loop('HOME.DROP.CAT3', array('CAT3'=>$r));
				}
			}
			//insert DROP block last, insert CAT block first
			$xtpl->insert_loop("HOME.DROP",array('DROP'=>$t));
		}
	}
	$xtpl->assign('pagers',$pagers);
	$xtph->assign('title', 'OceanGate');
	$xtpl->parse('HOME');
    $content = $xtpl->text("HOME");