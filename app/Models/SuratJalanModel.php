<?php
namespace App\Models;
use CodeIgniter\Model;

class SuratJalanModel extends Model{
    protected $table = 'surat';
    protected $allowedFields = ['truck_id', 'berat','jam_tanggal','tujuan','status'];


    function create($data){        
        return $this->insert($data);
    }
}
 