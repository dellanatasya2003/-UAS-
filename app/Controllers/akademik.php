<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AkademikModel;

class akademik extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new AkademikModel();

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
                'aktif' => 'active',
            ],
            'bobot'  => [
                'title' => 'bobot',
                'link' => base_url(). '/bobot',
                'icon' => 'fa-solid fa-bookmark',
                'aktif' => '',
            ],
        ];
        $this->rules = [
          'tahun' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'tahun tidak boleh kosong',
            ]
            ],
          'sebaran' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'sebaran tidak boleh kosong',
            ]
            ],  
        ];
    }
    
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">akademik</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item active">Akademik</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Akademik" ;
        

        $query = $this->pm->find();
        $data['data_akademik'] = $query; 
        return view('akademik/content', $data) ;
    } 

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Akademik</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url()  .'/akademik">Akademik</a></li>
                                <li class="breadcrumb-item active">Tambah Akademik</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Akademik' ;
        $data['action'] = base_url() . '/akademik/simpan' ;
        return view('akademik/input', $data);
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
        return redirect()->to('akademik')->with('success', 'Data berhasil disimpan');
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
            return redirect()->to('akademik')->with('success', 'Data akademik dengan kode '.$id.' berhasil dihapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('akademik')->with('error',$e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Akademik</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url()  .'/akademik">akademik</a></li>
                                <li class="breadcrumb-item active">Edit akademik</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Akademik' ;
        $data['action'] = base_url() . '/akademik/update' ;

        $data['edit_data'] = $this->pm->find($id);
        return view('akademik/input', $data);
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
            return redirect()->to('akademik')->with('success', 'Data berhasil diupdate');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashData('error', $e->getMessage());
            return redirect()->back->withInput();
        }
    }
} 