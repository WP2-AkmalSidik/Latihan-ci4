<?php

namespace App\Controllers\Saya;
use App\Controllers\BaseController;
class Pages extends BaseController
{
    public function index(): string
    {
        return view('home');
    }
    function about($kontak)
    {
        echo "<h1>Saya adalah saya, bisa hubungi saya Melalui $kontak </h1>";
        // return view('about'); 
        $this->wa();
    }
    protected function wa()
    {
        echo "<h1>Privasi => 085861664398</h1>";
    }
    function saya_sesi()
    {
        // $session = \Config\Services::session();
        $session = session();
        if($session->get('username')){
            echo "<h1>Session Username ada dengan isi : ".$session->get('username')."</h1>";
        } else{
            echo "<h1>Username Tidak Ditemukan</h1>";
        }
    }
}
