<?php
    /*$xtpu = new XTemplate('views/addproduct.html');
    $f=1;
    $file = $_FILES['txtFileName'];
    if(strlen($file['name'])>0){
        $fName    = $file['name'];
        $tmpName  = $file['tmp_name'];
        $fSize    = $file['size'];
        $arExt    = array('png','jpg','bmp','gif');
        $maxSize  = 2000000;
        $ext = getExt($fName);
        $urlServerFile = "./img";
        $newFileName = time().'_'.$fSize.'_'.$fName;
        if($fSize>$maxSize){
            $f = -1;
        }
        if(!in_array($ext,$arExt)){
            $f = -2;
        }
        if($f==1){
            if(move_uploaded_file($tmpName, $urlServerFile."/".$newFileName)){
                $f = 2;
            }
        }
    }

    function getExt($str){
        $aExt = explode('.',$str);
        $ext = end($aExt);
        return strtolower($ext);
    }

    $xtpu->parse('PRO'); 