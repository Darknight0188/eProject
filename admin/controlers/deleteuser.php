<?php
        $xtpd = new XTemplate('views/users.html');
        $id = $_GET['id'];
        $delete = $db->deleteId('users',$id);
        $f->redir('?a=users');

        $xtpd->parse('USERS');