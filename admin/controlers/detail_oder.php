<?php
    $xtpd = new XTemplate('views/detail_oder.html');
    function price($price){
        $price = number_format($price, 2, ',', '.');
        $split = explode(',', $price);
        if($split[1] == '00') $price = str_replace(',00', '', $price);
        return $price;
    }
    if($_POST){
		$keyword = $_POST['txtkeyword'];
		if(strlen($keyword)>0){
			$kw = strtolower($keyword);
			$kw = str_replace('','%',$kw);
			$condition .= "AND (LOWER(name) LIKE '%{$kw}%' AND phone = {$kw})";
		}
	}
    $id = $_GET['id'];
    $sql1 = "SELECT transaction.*, users.name as username FROM transaction INNER JOIN users ON transaction.users_id = users.id WHERE transaction.id=$id";
    $sql = "SELECT oders.price as price, oders.qty as quantity, product.name as product_name, transaction.id, users.name FROM transaction INNER JOIN oders ON transaction.id = oders.transaction_id INNER JOIN product ON product.id=oders.product_id INNER JOIN users ON transaction.users_id = users.id WHERE transaction.id = $id";
    $bill = $db->fetch($sql);
    if(count($bill)>0){
        foreach($bill as $r){
            $r['total'] = $r['price']*$r['quantity'];
            $r['total'] = price($r['total']);
            $r['price'] = price($r['price']);
            $xtpd->insert_loop("BILL.LP",array('LP'=>$r));
        }
    }
    $cus_name = $db->fetch($sql1);
    if(count($cus_name)>0){
        foreach($cus_name as $c){
            
            $xtpd->insert_loop("BILL.NA",array('NA'=>$c));
        }
    }


    $xtpd->parse('BILL');
    $content = $xtpd->text('BILL');