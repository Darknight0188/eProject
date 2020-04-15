<?php
    $xtpd = new XTemplate('views/product.html');
    $id = $_GET['id'];
    $delete = $db->deleteId('product',$id);
    $f->redir('?a=product');

    $xtpd->parse('LIST');