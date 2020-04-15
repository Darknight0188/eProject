<?php
    $id = $_GET['id'];
    $cart = $_SESSION['cart_id'];
    // echo $cart."<br>";
    $cart = explode(',', $cart);
    $id_arr = [];
    $qty_arr = [];
    foreach($cart as $r){
        $r = explode(': ', $r);
        array_push($id_arr, $r[0]);
        array_push($qty_arr, $r[1]);
    }
    for($i = 0; $i < count($cart); $i++){
        if($id_arr[$i] == $id){
            $pos = $i;
            break;
        }
    }
    // echo $pos."<br>";
    for($i = $pos; $i < count($cart); $i++){
        if($i == (count($cart) - 1)){
            unset($id_arr[$i]);
            unset($qty_arr[$i]);
        }else{
            $id_arr[$i] = $id_arr[$i + 1];
            $qty_arr[$i] = $qty_arr[$i + 1];
        }
    }
    for($i = 1; $i < (count($cart) - 1); $i++){
        $cart[$i] = $id_arr[$i].": ".$qty_arr[$i];
    }
    unset($cart[(count($cart) - 1)]);
    $cart = implode(',', $cart);
    // var_dump($cart);
    $_SESSION['cart_id'] = $cart;
    $f->redir('?m=cart&a=cart');