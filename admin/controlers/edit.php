<?php
    $xtpa = new XTemplate("views/list.html");
    $xtpe = new XTemplate("views/edit.html");
   
    $condition = '1=1';
   
    $id = $_GET['id'];
    $edit = $db->fetchAll('category',"Id=$id");
    $name = $edit[0]['name'];
    $xtpe->assign('name',$name);
    
    $do_save = 1;
    if($_POST){
        $name = $_POST['name'];
        $arr['name'] = "'{$name}'";
        if($name == ''){
            $xtpa->assign('erro','Enter name categories');
        }else{
            $pl = "name = '$name', type = '$type'";
            $db->editInfo('category',$pl,$id);
            $f->redir('?a=list');
        }
    }
    $xtpa->parse('TABLE');
    $xtpe->parse('EDIT');
    $content = $xtpe->text('EDIT');