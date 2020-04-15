<?php
    $xtpa = new XTemplate('views/edittemp.html');
        if($_POST){
        $type = $_POST['type_pro'];    
        $arr['name'] = "'{$type}'";
        if($type == ''){
            $xtpa->assign('erro_type','Enter type of product');
        }else{
            $pl = "name = '$name'";
            $db->editInfo('temp',$pl,$id);
            $f->redir('?a=temp');
            }
        }




    $xtpa->parse('EDITTEMP');
    $content = $xtpa->text('EDITTEMP');