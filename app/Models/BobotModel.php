<?php

namespace App\Models;

use CodeIgniter\Model;

class BobotModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bobot';
    protected $primaryKey       = 'nilai';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['nilai','bobot'];

}
