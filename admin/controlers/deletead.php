<?php
    if($_SESSION['admin'] != 1){
        $f->redir('?a=product');
    }else{
        $xtpd = new XTemplate('views/admin.html');
        $id = $_GET['id'];
        $delete = $db->deleteId('admin',$id);
        $f->redir('?a=admin');

        $xtpd->parse('ADMIN');
    }