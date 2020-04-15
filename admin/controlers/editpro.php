<?php
    $xtpa = new XTemplate("views/product.html");
    $xtpe = new XTemplate("views/editpro.html");
    $id = $_GET['id'];
    $edit = $db->fetchAll('product',"id=$id");
    $condition = '1=1';
    $category = $db->fetchAll('category',$condition);
    if(count($category)>0){
        foreach($category as $r){
            if($r['id'] == $edit[0]['category_id']) $r['selected'] = 'selected';
            $xtpe->insert_loop("EDITP.PR",array('PR'=>$r));
        }
    }
    $type = $db->fetchAll('temp'," 1=1 ");
        if(count($type)>0){
            foreach($type as $r){
                $xtpa->insert_loop("EDITP.TY",array('TY'=>$r));
            }
        }

    
    $name = $edit[0]['name'];
    $category_id = $edit[0]['category_id'];
    $temp_id = $edit[0]['temp_id'];
    $price = $edit[0]['price'];
    $number = $edit[0]['number'];
    $thunbar = $edit[0]['thunbar'];
    // echo $thunbar."<br>";
    $content = $edit[0]['content'];
    $sale = $edit[0]['sale'];
    $xtpe->assign('name',$name);
    $xtpe->assign('PR.id',$category_id);
    $xtpe->assign('price',$price);
    $xtpe->assign('number',$number);
    $xtpe->assign('pro_des',$content);
    $xtpe->assign('sale',$sale);
    $do_save = 1;
    if($_POST){
        $name = $_POST['name'];
        $slug = $f->to_Slug($name);
        $price = $_POST['price'];
        $number = $_POST['number'];
        $sale = $_POST['sale'];
        $description = $_POST['txtProDes'];
        $category_id = $_POST['category_id'];
        $temp_id = $_POST['temp_id'];
        if($_FILES['txtFileName']['name'] != ''){
            $img_name = $_FILES['txtFileName']['name'];
            $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_new_name = substr($img_name, 0, - strlen($img_ext)-1)."_".time().".".$img_ext;
            $img_tmp = $_FILES['txtFileName']['tmp_name'];
            $img_size = $_FILES['txtFileName']['size'];
            $img_size_limit = 3000000;
            $ext_arr = array('jpeg','jpg','png','bmp');
            if(in_array($img_ext, $ext_arr)&& $img_size < $img_size_limit){
                move_uploaded_file($img_tmp,"./img/".$img_new_name);
            }
            $url = $baseUrl."admin/img/".$img_new_name;
            // echo $url."<br>";
        }else $url = $thunbar;
        // echo $url;   
        // $arr['name'] = "'{$name}'";
        // $arr['slug'] = "'{$slug}'";
        // $arr['price'] = "'{$price}'";
        // $arr['number'] = "'{$number}'";
        // $arr['sale'] = "'{$sale}'";
        // $arr['thunbar'] = "'{$url}'";
        // $arr['category_id'] = "'{$category_id}'";
        // $arr['content'] = "'{$description}'";
       
        if($valid->isString($name) == 'NO'){
            $do_save=0;
            $erro_name = 'Name of product is invalid!';
            $xtpa -> assign('erro_name',$erro_name);
        }
        

        if($valid->isPrice($price) == 'NO'){
            $do_save = 0;
            $erro_price = 'Price is Invalid!';
            $xtpa->assign('erro_price',$erro_price);
        }
        

        if($category_id == ''){
            $do_save = 0;
            $erro_category = 'Choose category!';
            $xtpa->assign('erro_category',$erro_category);
        }

        if($temp_id == ''){
            $do_save = 0;
            $erro_category = 'Choose type!';
            $xtpa->assign('erro_temp',$erro_category);
        }
        

        if($description == ''){
            $do_save = 0;
            $erro_content = 'Write something in content';
            $xtpa->assign('erro_content',$erro_content);
        }
       
        if($valid->isPrice($number) == 'NO'){
            $do_save = 0;
            $erro_number = 'Number is Invalid!';
            $xtpa->assign('erro_number',$erro_number);
        }
        if($do_save == 1 && isset($_FILES['txtFileName'])){
            $pl = "name = '$name', number = '$number', thunbar = '$url', category_id = '$category_id', temp_id = '$temp_id', content = '$description', sale = '$sale'";
            $db->editInfo('product',$pl,$id);
            $f->redir('?a=product');
        }
    }
    $xtpa->parse('LIST');
    $xtpe->parse('EDITP');
    $content = $xtpe->text('EDITP');