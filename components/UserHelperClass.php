<?php

namespace app\components;

class UserHelperClass
{
    //userHelperClass::pre('param');
    public static function pre($arr=false)
    {
        $debug = debug_backtrace();
        echo "<pre  style='background:#fff; color:#000; border:1px solid #CCC;padding:10px;border-left:4px solid red; font:normal 11px Arial;'><small>".str_replace($_SERVER['DOCUMENT_ROOT'],"",$debug[0]['file'])." : {$debug[0]['line']}</small>\n".print_r($arr,true)."</pre>";
    }
}