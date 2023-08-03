<?php

namespace App\Models;

use CodeIgniter\Model;

class MatkulModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'matkul';
    protected $primaryKey       = 'kode';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['kode','nama','sks'];

}
