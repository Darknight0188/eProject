<?php
    $xtpa = new XTemplate('views/addnew.html');
      
        $do_save = 1;
        if($_POST){
        $name = $_POST['name'];
        $arr['name'] = "'{$name}'";
        if($name == ''){
            $xtpa->assign('erro','Enter brand!');
        }else {
        $db->insert('category',$arr);
        $f->redir('?a=list');
        }
    }  
         
            




    $xtpa->parse('ADD');
    $content = $xtpa->text('ADD');