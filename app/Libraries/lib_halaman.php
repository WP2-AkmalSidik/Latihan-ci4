<?php
namespace App\Libraries;
class lib_halaman
{
    function info($parameter)
    {
        $data['parameter'] = $parameter;
        return view("komponen/halaman_info",$data);
    }
}