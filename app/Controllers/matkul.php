<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MatkulModel;

class matkul extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new MatkulModel();

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
                'aktif' => 'active',
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
        $this->rules = [
          'kode' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'kode tidak boleh kosong',
            ]
            ],
          'nama' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'nama tidak boleh kosong',
            ]
            ],  
             'sks' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'sks tidak boleh kosong',
                ]
                ],  
        ];
    }
    
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">matkul</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item active">Matkul</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Matkul" ;
        

        $query = $this->pm->find();
        $data['data_matkul'] = $query; 
        return view('matkul/content', $data) ;
    } 

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Matkul</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url()  .'/matkul">Matkul</a></li>
                                <li class="breadcrumb-item active">Tambah Matkul</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Matkul' ;
        $data['action'] = base_url() . '/matkul/simpan' ;
        return view('matkul/input', $data);
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
        return redirect()->to('matkul')->with('success', 'Data berhasil disimpan');
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
            return redirect()->to('matkul')->with('success', 'Data matkul dengan kode '.$id.' berhasil dihapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('matkul')->with('error',$e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Matkul</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url()  .'/matkul">matkul</a></li>
                                <li class="breadcrumb-item active">Edit matkul</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Matkul' ;
        $data['action'] = base_url() . '/matkul/update' ;

        $data['edit_data'] = $this->pm->find($id);
        return view('matkul/input', $data);
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
            return redirect()->to('matkul')->with('success', 'Data berhasil diupdate');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashData('error', $e->getMessage());
            return redirect()->back->withInput();
        }
    }
} 