<?php

namespace App\Util;

class Crypt{

    public static function encryptMD5($str){
        return strtoupper(md5(trim($str)));
    }


}