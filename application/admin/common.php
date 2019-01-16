<?php

function getQrcode($url){
    /*生成二维码*/
    vendor("phpqrcode.phpqrcode");
    $data =$url;
    $level = 'L';// 纠错级别：L、M、Q、H
    $size =4;// 点的大小：1到10,用于手机端4就可以了
    $QRcode = new \QRcode();
    ob_start();
    $QRcode->png($data,false,$level,$size,2);
    $imageString = base64_encode(ob_get_contents());
    ob_end_clean();
    return "data:image/jpg;base64,".$imageString;
}