<?php
    include("../libs/bootstrap.php");
    $xtpt = new XTemplate('views/forgot_password.html');



    $xtpt->parse('FORGOT_PASSWORD');
    $xtpt->out('FORGOT_PASSWORD');
