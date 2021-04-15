<?php

namespace App\Services\Layout;
use Illuminate\Support\Facades\Hash;

class Layout
{
    
    public static function getlLayoutKey(){
        $key = hash('sha256', "@layout-hash@");
        return $key;
    }

    public static function checkLayoutKey(){
        if (isset(request()->ajax_layout_load)) {
            if (request()->ajax_layout_load == self::getlLayoutKey()) {
                return true;
            }
        }
        return false;
    }

    public static function get()
    {
        return "layouts.default";
       // return self::checkLayoutKey()?"layouts.ajax":"layouts.default";
    }
}
