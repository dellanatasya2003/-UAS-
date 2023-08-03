<?php

namespace App\Models;

use CodeIgniter\Model;

class StudiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'studi';
    protected $primaryKey       = 'prodi';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['prodi','jenjang'];

}
