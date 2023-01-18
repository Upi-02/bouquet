<?php

namespace App\Controllers;

use App\Models\Users; //include akun model di dalam controller

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        $session->destroy();
        //return redirect()->to('/login');

        return view('login'); // memanggil view di app/views/login.php
    }
    public function cekLogin()
    {
        $akun = model(Users::class);
        $hasil = $akun->cekUsernamePassword();
        foreach ($hasil as $row) {
            $jml = $row->jumlah; //atribut hasil query diberi alias jml
        }
        if($jml==0){
            // artinya tidak ada pasangan username dan password yang cocok, kembalikan ke halaman login 
            session()->setFlashdata('error','Pasangan username dan password tidak tepat');
            return redirect()->to('home');
        }else{
            // artinya ada pasangan username dan password yang cocok, teruskan ke halaman welcome_message
            // return view('welcome_message');
            
            /* echo view('Templates/HeaderBootstrap');
            echo view('Templates/SidebarBootstrap');
            echo view('Templates/BodyBootstrap');
            echo view('Templates/FooterBootstrap'); */

            // aktifkan session dan simpan username ke dalam session serta buat variabel logged_in
            $session = session();
            $ses_data = [
                'user_name'     => $_POST['username'],
                'logged_in'     => TRUE
            ];
            $session->set($ses_data);

            // load data kos dan kirim ke view
            echo view('struktur/header');
            echo view('struktur/sidebar');
            echo view('dashboard/dashboard',
                        [
                            'title' => 'Dashboard'
                        ]
                    );
            echo view('struktur/footer');        
        }
    }
}
