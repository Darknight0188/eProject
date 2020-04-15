<?php
    $xtpa = new XTemplate('views/addproduct.html');
        $condition = '1=1';
        $category = $db->fetchAll('category',$condition);
        if(count($category)>0){
            foreach($category as $r){
                $xtpa->insert_loop("PRO.SL",array('SL'=>$r));
            }
        }
        $type = $db->fetchAll('temp'," 1=1 ");
        if(count($type)>0){
            foreach($type as $r){
                $xtpa->insert_loop("PRO.TY",array('TY'=>$r));
            }
        }
        $do_save = 1;
        if($_POST && $_FILES){
        $name = $_POST['name'];
        $slug = $f->to_Slug($name);
        $price = $_POST['price'];
        $number = $_POST['number'];
        $sale = $_POST['sale'];
        $description = $_POST['txtProDes'];
        $category_id = $_POST['category_id'];
        $temp_id = $_POST['temp_id'];
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
        $arr['name'] = "'{$name}'";
        $arr['slug'] = "'{$slug}'";
        $arr['price'] = "'{$price}'";
        $arr['sale'] = "'{$sale}'";
        $arr['number'] = "'{$number}'";
        $arr['thunbar'] = "'{$url}'";
        $arr['category_id'] = "'{$category_id}'";
        $arr['temp_id'] = "'{$temp_id}'";
        $arr['content'] = "'{$description}'";
       
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
            $erro_temp = 'Choose type!';
            $xtpa->assign('erro_temp',$erro_category);
        }

        if($description == ''){
            $do_save = 0;
            $erro_content = 'Write something in content';
            $xtpa->assign('erro_content',$erro_content);
        }
        

        if($_FILES['txtFileName']['name'] == ''){
            $do_save = 0;
            $erro_thunbar = 'Choose picture';
            $xtpa->assign('erro_thunbar',$erro_thunbar);
        }

        if($valid->isPrice($number) == 'NO'){
            $do_save = 0;
            $erro_number = 'Number is Invalid!';
            $xtpa->assign('erro_number',$erro_number);
        }


        if($do_save == 1){
            $db->insert('product',$arr);
            $f->redir('?a=product');
        }
    }


    $xtpa->parse('PRO');
    $content = $xtpa->text('PRO');
    