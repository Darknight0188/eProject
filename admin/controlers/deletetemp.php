<?php
    $xtpd = new XTemplate('views/temp.html');
    $id = $_GET['id'];
    $delete = $db->deleteId('temp',$id);
    $f->redir('?a=temp');

    $xtpd->parse('TEMP');