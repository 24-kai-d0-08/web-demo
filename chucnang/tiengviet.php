<?php
function tiengviet($str)
{
    $str=preg_replace("/(ă|â|ắ|ẵ|ằ|ẳ|ặ|ấ|ầ|ẫ|ậ|ẩ|ạ|á|ã|ả|ạ|à)/","a",$str);
    $str=preg_replace("/(Â|Ấ|Ẫ|Ầ|Ẩ|Ậ|A|Á|Ã|À|Ả|Ạ|Ặ|Ắ|Ă|Ầ|Ẳ|Ẵ)/","A",$str);
    $str=preg_replace("/(ô|ỗ|ổ|ồ|ố|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ò|ó|ỏ|õ|ọ)/","o",$str);
    $str=preg_replace("/(Ô|Ố|Ổ|Ỗ|Ộ|Ồ|Ơ|Ợ|Ớ|Ờ|Ở|Ỡ|Ó|Ò|Ỏ|Õ|Ọ)/","O",$str);
    $str=preg_replace("/(ê|ễ|ế|ề|ể|ệ|é|è|ẽ|ẹ|ẻ)/","e",$str);
    $str=preg_replace("/(Ê|Ế|Ể|Ệ|Ề|Ễ|É|Ẻ|È|Ẽ|Ẹ)/","E",$str);
    $str=preg_replace("/(ù|ú|ủ|ũ|ụ|ự|ừ|ứ|ữ|ử|ư)/","u",$str);
    $str=preg_replace("/(Ù|Ú|Ủ|Ũ|Ụ|Ự|Ừ|Ứ|Ũ|Ử|Ư)/","U",$str);
    $str=preg_replace("/(í|ỉ|ị|ĩ|ì)/","i",$str);
    $str=preg_replace("/(Í|Ỉ|Ị|Ĩ|Ì)/","I",$str);
    $str=preg_replace("/(ý|ỳ|ỵ|ỷ|ỹ)/","y",$str);
    $str=preg_replace("/(Ỹ|Ỳ|Ỵ|Ỷ|Ỹ)/","Y",$str);
    $str=preg_replace("/(đ)/","d",$str);
    $str=preg_replace("/(Đ)/","D",$str);
    $str=preg_replace("/( )/","-",$str);
    return $str;
}

?>