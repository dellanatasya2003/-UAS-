<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'npm';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['npm','nama','alamat','asrama'];

}
