<?php
    $xtpa = new XTemplate('views/addtemp.html');
        if($_POST){
        $type = $_POST['type_pro'];    
        $arr['name'] = "'{$type}'";
        if($type == ''){
            $xtpa->assign('erro_type','Enter type of product');
        }else{
             $db->insert('temp',$arr);
             $f->redir('?a=temp');
            }
        }




    $xtpa->parse('ADDTEMP');
    $content = $xtpa->text('ADDTEMP');