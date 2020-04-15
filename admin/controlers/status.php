<?php
    $xtps = new XTemplate('views/cart.html');
    $id = $_GET['id'];
    $sql = "SELECT * FROM transaction WHERE id=$id";
    $rs = $db->fetch($sql);
    if(count($rs)>0){
		foreach($rs as $r){
            if($r['status'] == 0){
                $pl = 'status = 1';
                $update = $db->editInfo('transaction',$pl,$id);
                $sql = "SELECT product_id,qty FROM oders WHERE transaction_id = $id";
                $order = $db->fetch($sql);
                foreach($order as $item){
                    $idproduct = intval($item['product_id']);
                    $product = $db->fetchAll('product',"id = $idproduct");
                    $number = $product[0]['number'] - $item['qty'];
                    $pay = +1;
                    $pt = "number = '$number',pay ='$pay'";
                    $up_pro = $db->editInfo('product',$pt,$idproduct);
                }
            } else{
              $pl = 'status = 0';
              $update =  $db->editInfo('transaction',$pl,$id);
              $sql = "SELECT product_id,qty FROM oders WHERE transaction_id = $id";
              $order = $db->fetch($sql);
              foreach($order as $item){
                  $idproduct = intval($item['product_id']);
                  $product = $db->fetchAll('product',"id = $idproduct");
                  $number = $product[0]['number'] + $item['qty'];
                  $pay = -1;
                  $pt = "number = '$number',pay = '$pay'";
                  $up_pro = $db->editInfo('product',$pt,$idproduct);
              }
            }
            $f->redir('?a=cart');
		}
    }

   
   
    $xtps->parse('CART_AD');