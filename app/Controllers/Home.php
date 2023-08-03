<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $menu = [
            'beranda' => [
                'title' => 'Beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house',
                'aktif' => 'active',
            ],
            'mahasiswa' => [
                'title' => 'Mahasiswa',
                'link' => base_url() . '/mahasiswa',
                'icon' => 'fa-solid fa-users',
                'aktif' => '',
            ],
            'studi' => [
                'title' => 'Studi',
                'link' => base_url(). '/studi',
                'icon' => 'fa-solid fa-user',
                'aktif' => '',
            ],
            'matkul'  => [
                'title' => 'matkul',
                'link' => base_url(). '/matkul',
                'icon' => 'fa-solid fa-clipboard-list',
                'aktif' => '',
            ],
            'akademik'  => [
                'title' => 'akademik',
                'link' => base_url(). '/akademik',
                'icon' => 'fa-solid fa-list',
                'aktif' => '',
            ],
            'bobot'  => [
                'title' => 'bobot',
                'link' => base_url(). '/bobot',
                'icon' => 'fa-solid fa-bookmark',
                'aktif' => '',
            ],
        ];
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Beranda</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active"><a href="#">Beranda</a></li>
                            </ol>
                       </div>';
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Welcome to KHS FAKULTAS SAINTEK";
        $data['selamat_datang'] = "Selamat datang di aplikasi KHS Saintek";
        return view('template/content', $data) ;    
    }
}
