<?php
    $xtpf = new XTemplate('views/aboutUs/aboutUs.html');


    $xtpf->parse('ABOUTUS');
    $content = $xtpf->text('ABOUTUS');