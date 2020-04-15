<?php
    $xtpd = new XTemplate('views/list.html');
    $id = $_GET['id'];
    $delete = $db->deleteId('category',$id);
    $f->redir('?a=list');

    $xtpd->parse('TABLE');