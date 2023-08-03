<?php

namespace App\Models;

use CodeIgniter\Model;

class AkademikModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'akademik';
    protected $primaryKey       = 'tahun';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['tahun','sebaran'];

}
