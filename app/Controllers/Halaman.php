<?php

namespace App\Controllers;

use App\Models\Model_halaman;
use App\Models\ModelCustom;

class Halaman extends BaseController
{
    public function index()
    {
        $data['title'] = "Tetap Tersenyum";
        $data['judul_halaman'] = "Jaga Mental";
        $data['isi_Halaman'] = "Semoag Senyum mu ibadah";
        $data['manfaat'] = ['Pahala', 'Memperpanjang Silatuhrahmi', 'Memperpanjang Umur'];

        // echo view("konten/header",$data);
        echo view('konten/Halaman', $data);
        // echo view("konten/footer");
    }
    public function info()
    {
        return "Ditulis di kategori : <b>Berita</b>, Penulis: <b>Akml</b>";
    }
    // CRUD : Create, Read, Update, Delete
    public function halaman_create()
    {
        $ModelHalaman = new Model_halaman();
        if ($this->request->getMethod() == 'post') {
            $dataHalaman = [
                'halaman_judul' => $_POST['halaman_judul'],
                'halaman_isi' => $_POST['halaman_isi']
            ];
            $ModelHalaman->save($dataHalaman); //Berguna Unutk Insert dan Update
        }
        $data['title'] = "Memasukan Data Baru";
        echo view("konten/halaman_create", $data);
    }

    public function halaman_read()
    {
        $ModelHalaman = new Model_halaman();
        $data['title'] = "Menampilkan Data Data Baru";
        $data['halaman_isi'] = $ModelHalaman->findAll();
        echo view("konten/halaman_red", $data);
    }

    public function halaman_update($id)
    {
        $ModelHalaman = new Model_halaman();
        $data['title'] = "Melakukan Update Data";
        if ($this->request->getMethod() == 'post') {
            $dataHalaman = [
                'id_halaman' => $id,
                'halaman_judul' => $_POST['halaman_judul'],
                'halaman_isi' => $_POST['halaman_isi']
            ];
            $ModelHalaman->save($dataHalaman); //Berguna Unutk Insert dan Update
        }
        $data['halaman_isi'] = $ModelHalaman->find($id);
        echo view("konten/halaman_update", $data);
    }
    public function halaman_delete($id)
    {
        $ModelHalaman = new Model_halaman();
        $ModelHalaman->delete($id);
    }

    public function halaman_cek()
    {
        $halamancustom = new ModelCustom();
        $data = $halamancustom->getData();
        print_r($data);
    }

    public function halaman_detail($kategori, $id) //Localhost:8080/halaman/halaman_detail
    {
        echo "<h1>Halaman detail dari kategori : $kategori, dengan id $id</h1>";
    }

    public function halaman_detail_by_judul($judul) //string atau karakter
    {
        echo "<h1>Saya bagian halaman judul dengan judul : $judul</h1>";
    }

    public function halaman_detail_by_id($id) //num atau angka
    {
        echo "<h1>Saya bagian halaman id dengan id : $id</h1>";
    }

    //Method POST dan GET
    public function halaman_form_get()
    {
        echo view("konten/halaman_form_get");
    }

    public function halaman_form_post()
    {
        echo "<h1>Aww Saya Di Click Dudee</h1>";
    }

    //Validasi Data CI4
    public function halaman_form_validasi()
    {
        $data[] = "";
        if ($this->request->getMethod() == "post") // POST dan post beda, harap perhatikan
        {
            // var_dump($this->request->getVar());
            $nama = $this->request->getVar('nama');
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $konfirmasi_password = $this->request->getVar('konfirmasi_password');

            $validation = \Config\Services::validation();

            $aturan = [
                // "nama" => [
                //     "label" => "Nama",
                //     "rules" => "required|min_length[5]",
                //     "errors" => [
                //         'required' => "{field} Harus Diisi",
                //         'min_length' => "{field} harus minimal 5 karakter"
                //     ]
                // ],
                // "email" => [
                //     "label" => "Email",
                //     "rules" => "required|valid_email",
                //     "errors" => [
                //         'required' => "{field} Harus Diisi",
                //         'valid_email' => "Alamat email tidak valid cok!"
                //     ]
                // ],
                // "password" => [
                //     "label" => "Password",
                //     "rules" => "required",
                //     "errors" => [
                //         'required' => "{field} Harus Diisi",
                //     ]
                // ],
                // "konfirmasi_password" => [
                //     "label" => "Konfirmasi Password",
                //     "rules" => "required|matches[password]",
                //     "errors" => [
                //         'required' => "{field} Harus Diisi",
                //         'matches' => "Konfirmasi Password tidak sesuai dengan yang sebelumnya",
                //     ]
                // ],
                'gambar' => [
                    'label' => 'gambar',
                    'rules' => 'uploaded[gambar]|max_size[gambar,1024]|is_image[gambar]|max_dims[gambar,1024,780]',
                    'errors' => [
                        'uploaded' => 'Silahkan Masukan {field}',
                        'max_size' => 'Maksimum Ukuran 1MB',
                        // 'ext_in' => 'File Gambar Harus JPG bro!'
                        'is_image' => 'File harus Gambar',
                        'max_dims' => 'Maksimum Dimensi Adalah 1024x780',
                    ]
                ]
            ];

            $validation->setRules($aturan);
            if ($validation->withRequest($this->request)->run()) { //True
                // echo "<h1>AMAN BANG</h1>";
                // session()->setFlashdata("sukses","Berhasil Validasi Data");
                // return redirect()->back();
                //     $gambar = $this->request->getfile('gambar');
                //     echo "Nama File Gambar : " . $gambar->getName();
                //     if($gambar->isValid()   && !$gambar->hasMoved()){
                //         $gambar->move("./upload/gambar/", $gambar->getRandomName() ); //"Gambar-saya." . $gambar->getExtension()); Melakukan penamaan gambar sesuai keinginan
                //         $gambar = $this->request->getfile('gambar');
                //         echo "<br>Nama File Gambar Baru : " . $gambar->getName();
                //     }
                $file = $this->request->getFiles();
                foreach ($file['gambar'] as $gambar) {
                    if ($gambar->isValid() && !$gambar->hasMoved()) {
                        $gambar->move("./upload/multipleGambar/", $gambar->getRandomName()); //"Gambar-saya." . $gambar->getExtension()); Melakukan penamaan gambar sesuai keinginan
                        // $gambar = $this->request->getfile('gambar');
                        echo "<br>Nama File Gambar Baru : " . $gambar->getName();
                    }
                }
                session()->setFlashdata("sukses", "Berhasil Upload Data");
                return redirect()->back();
                // } else { //False
                // $error = $validation->listErrors();
                // $error = $validation->getErrors();
                // print_r($error);
                // echo "<h1>ADA MASALAH NGAB</h1>";
                // session()->setFlashdata('error', $error);
                // $data['error'] = $error;
                // return redirect()->back()->withInput();
            }
        }
        echo view("konten/halaman_form_validasi", $data);
    }
    function halaman_sesi()
    {
        $session = \Config\Services::session();
        $session->set("username", "dirumahakml");
        echo "<h1>Session Dibentuk</h1>";
    }
    function halaman_akml() //oprasi modifikasi gambar
    {
        $gambar_akml = \Config\Services::image();
        $gambar_akml->withFile("./upload/gambar/akml.png");
        $gambar_akml->fit("500", "500", "center"); //mengubah ukuran Gambar
        // $gambar_akml->reorient();
        // $gambar_akml->rotate(90); //Untuk rotasi dan crop
        // $gambar_akml->crop(200, 200, 0, 0);
        // $gambar_akml->flip("horizontal"); //membalikan posisi gambar kiri ke kanan, kana ke kiri dan atsa kebawah, bawah ke atas

        $gambar_akml->save("./upload/gambar/akmals.png");
        echo "<h1>Operasi Berhasil</h1>";
    }
    function halaman_email()
    {
        $email = \Config\Services::email();
        $alamat_email = "akmalsidik28@gmail.com";
        $email->setTo($alamat_email);
        $alamat_pengirim = "akmalsidik18@gmail.com";
        $email->setFrom($alamat_pengirim);
        $subject = "Test Saja";
        $email->setSubject($subject);
        $isi_pesan = "Semoga Kuat Sampai Tamat...";
        $email->setMessage($isi_pesan);
        if($email->send()){
            echo "<h1>Pesan Terkirim silahkan Cek</h1>";
        } else{
            echo "<h1>Pesan Gagal dikirmkan</h1>";
            $data_error = $email->printDebugger();
            print_r($data_error);
        }
    }
    function transaksi()
    {
        $kustom = new ModelCustom();
        $kustom->prosesTransaksi();
        echo "<h1>proses dijalankan</h1>";
    }
}
