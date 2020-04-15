<?php
    $xtpy = new XTemplate('views/cart/pay.html');
    $condition = '1=1';
    $user_name = $_SESSION['user_cus'];
    $sql = "SELECT * FROM users WHERE name='{$user_name}'";
    $rs = $db->fetch($sql);
    $fullname = $rs[0]['name'];
    $phone = $rs[0]['phone'];
    $address = $rs[0]['address'];
    $email = $rs[0]['address'];
    $xtpy->assign('fullname',$fullname);
    $xtpy->assign('phone',$phone);
    $xtpy->assign('address',$address);
    $xtpy->assign('email',$email);
    $cart = $_SESSION['cart_id'];
    $cart = explode(',', $cart);
    $id_arr = array();
    $qty_arr = array();
    foreach($cart as $r){
        $r = explode(': ', $r);
        array_push($id_arr, $r[0]);
        array_push($qty_arr, $r[1]);
    }
    $id_sql = $id_arr;
    $id_sql	= preg_filter('/^/', '"', $id_sql);
    $id_sql	= preg_filter('/$/', '"', $id_sql);		
    $id_sql = implode(',', $id_sql);
    $item = $db->fetch("SELECT * FROM product WHERE id IN ({$id_sql})");			
    function price($price){
        $price = number_format($price, 2, ',', '.');
        $split = explode(',', $price);
        if($split[1] == '00') $price = str_replace(',00', '', $price);
        return $price;
    }
    $total = 0;
    foreach($item as $r){
        for($i = 0; $i < count($id_arr); $i++){
            if($r['id'] == $id_arr[$i]){
                $r['qty'] = $qty_arr[$i];						
                $r['total'] = $r['qty'] * $r['price'];
                $_SESSION['price'] = $r['total'];
                $total += $r['total'];
                $_SESSION['total'] = $total;
                $r['total'] = price($r['total']);
                $r['qty'] = price($r['qty']);
                $r['price'] = price($r['price']);
                $xtpy->insert_loop('PAY.LP', array('LP' => $r));
            }
        }		
    }
    if($_POST){
        $amount = $_SESSION['total'];
        $customer_id = $_SESSION['user_id'];
        $note = $_POST['Note'];
        $arr['amount'] =  "'{$amount}'";
        $arr['users_id'] =  "'{$customer_id}'";
        $arr['note'] =  "'{$note}'";
        $insert_token = $db->insert('transaction',$arr);
        $cart = $_SESSION['cart_id'];
        $cart = explode(',', $cart);
        if($insert_token == 1){
            $transaction = $db->fetch("SELECT MAX(id) as id FROM transaction");
            $id = $transaction[0]['id'];
            foreach ($cart as $r) {
                $r = explode(': ', $r);
                $ar['transaction_id'] = $id;
                $item_id = $r[0];
                $item = $db->fetch("SELECT price FROM product WHERE id = {$item_id}");
                $price = $item[0]['price'];
                $ar['price'] = $price;
                $ar['product_id'] = $r[0];
                $ar['qty'] = $r[1];
                $db->insert('oders',$ar);
            }

        }
    }   
  
    
    

    $xtpy->parse('PAY');
    $content = $xtpy->text('PAY');