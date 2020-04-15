<?php
    $xtpb = new XTemplate('views/whereToBuy/whereToBuy.html');


    $xtpb->parse('WHERETOBUY');
    $content = $xtpb->text('WHERETOBUY');