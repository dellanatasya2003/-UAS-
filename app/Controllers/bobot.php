<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BobotModel;

class bobot extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new BobotModel();

        $this->menu = [
            'beranda' => [
                'title' => 'Beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house',
                'aktif' => '',
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
                'aktif' => 'active',
            ],
        ];
        $this->rules = [
          'nilai' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'nilai tidak boleh kosong',
            ]
            ],
          'bobot' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'bobot tidak boleh kosong',
            ]
            ],  
        ];
    }
    
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">bobot</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item active">Bobot</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Bobot" ;
        

        $query = $this->pm->find();
        $data['data_bobot'] = $query; 
        return view('bobot/content', $data) ;
    } 

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Bobot</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url()  .'/bobot">Bobot</a></li>
                                <li class="breadcrumb-item active">Tambah Bobot</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Bobot' ;
        $data['action'] = base_url() . '/bobot/simpan' ;
        return view('bobot/input', $data);
    }
    public function simpan ()
    {
        if (strtolower($this->request->getMethod()) !== 'post') {
            
            return redirect()->back()->withInput();
        }
        if (!$this->validate($this->rules)) {

            return redirect()->back()->withInput();
        }

        $dt = $this->request->getPost();
        try {
        $simpan = $this->pm->insert($dt) ;
        return redirect()->to('bobot')->with('success', 'Data berhasil disimpan');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {

            session()->setFlashdata('error', $e->getMessage());
        return redirect()->back()->withInput();     
        }
    }
    public function hapus($id)
    {
        if(empty($id)) {
            return redirect()->back()->with('error', 'Hapus data gagal dilakukan');
        }
        try {
            $this->pm->delete($id) ;
            return redirect()->to('bobot')->with('success', 'Data bobot dengan kode '.$id.' berhasil dihapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('bobot')->with('error',$e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Bobot</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url()  .'/bobot">Bobot</a></li>
                                <li class="breadcrumb-item active">Edit bobot</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Bobot' ;
        $data['action'] = base_url() . '/bobot/update' ;

        $data['edit_data'] = $this->pm->find($id);
        return view('bobot/input', $data);
    }
    public function update()
    {
        $dtEdit = $this->request->getPost();
        $param = $dtEdit['param'];
        unset($dtEdit['param']);

        if(!$this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }
        try{
            $this->pm->update($param, $dtEdit);
            return redirect()->to('bobot')->with('success', 'Data berhasil diupdate');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashData('error', $e->getMessage());
            return redirect()->back->withInput();
        }
    }
} 