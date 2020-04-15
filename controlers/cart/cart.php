<?php
	$xtpc = new XTemplate("views/cart/cart.html");
	if(strlen($_SESSION['user_cus']) == ''){
		echo "<script>alert('Bạn phải đăng nhập mới thực hiện được chức năng này');location.href='http://localhost:8080/eProject/?m=home&a=home'</script>";	
	}else{
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$item = $db->fetch("SELECT * FROM product WHERE id = {$id}");
			$qty = $item[0]['number'];
			if($qty == 0){
				echo "<script>alert('This item is out of stock');location.href='http://localhost:8080/eProject/?m=home&a=home'</script>";
			}else{
				if(!isset($_SESSION['cart_id']) || $_SESSION['cart_id'] == ''){
					$_SESSION['cart_id'] = $id.': 1';
				}else{
					$cart = $_SESSION['cart_id'];				
					$cart = explode(',', $cart);
					$f = 0;
					foreach($cart as $key=>$r){
						$r = explode(': ', $r);
						$id_exist = $r[0];
						$quantity = $r[1];
						if($id == $id_exist){
							if($quantity < $qty){
								$new_quantity = $quantity + 1;
								$f = 1;
							}else{
								echo "<script>alert('Sorry, there is no more left');location.href='http://localhost:8080/eProject/?m=home&a=home'</script>";
								$f = 0;
								exit();
							}
							break;
						}
					}
					if($f == 1) $cart = preg_replace("/{$id}\:.*/", "{$id}: {$new_quantity}", $cart);
					else array_push($cart, "{$id}: 1");
					$cart = implode(',', $cart);
					$_SESSION['cart_id'] = $cart;
				}
			}
		}
		if(isset($_SESSION['cart_id']) && $_SESSION['cart_id'] != ''){
			$cart = $_SESSION['cart_id'];
			$cart = explode(',', $cart);
			$id_arr = [];
			$qty_arr = [];
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
						$xtpc->insert_loop('CART.CART_ITEM', array('LS' => $r));
					}
				}		
			}
			$total = price($total);
			$xtpc->assign('total', $total);
		}
		// $id = (isset($_GET['id']))?$_GET['id']:'';
		// $sql = "SELECT * FROM product WHERE id = $id";
		// $product = $db->fetchOne($sql);

		// if(!isset($_SESSION['cart'][$id])){
		// 	$_SESSION['cart'][$id]['name'] = $product['name'];
		// 	$_SESSION['cart'][$id]['thunbar'] = $product['thunbar'];
		// 	$_SESSION['cart'][$id]['price'] = $product['price'];
		// 	$_SESSION['cart'][$id]['qty'] = 1;
		// }else{
		// 	$_SESSION['cart'][$id]['qty'] += 1;
		// }

		// foreach($_SESSION['cart'] as $key => $value){
		// 	$xtpc->assign('thunbar',$value['thunbar']);
		// 	$xtpc->assign('name',$value['name']);
		// 	$xtpc->assign('price',$value['price']);
		// 	$xtpc->assign('number',$value['qty']);
		// 	$xtpc->assign('total',$value['qty']*$value['price']);
		// }
	}
	



	//echo "<script>alert('Thêm sản phẩm thành công');location.href='http://localhost:8080/eProject/?m=cart&a=cart'</script>";




	$xtpc->parse("CART");
    $content = $xtpc->text("CART");