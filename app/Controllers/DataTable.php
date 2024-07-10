<?php

namespace App\Controllers;

use DateTime;

class DataTable extends BaseController
{
    public function truck()
    {   
        $db = db_connect();
        $searchValue = $this->request->getVar('search')['value'];
        $start = $this->request->getVar('start') ?? 0;  // Default to 0 if not set
        $length = $this->request->getVar('length') ?? 10;  // Default to 10 if not set
        // Initialize the WHERE clause
        $whereClause = "";
        if (!empty($searchValue)) {
            // Ensure proper escaping and add wildcards for the LIKE comparison
            $searchValue = $db->escapeLikeString($searchValue);
            $whereClause = " WHERE truck.plat LIKE '%" . $searchValue . "%'" .
                        " OR truck.supir LIKE '%" . $searchValue . "%'" .
                        " OR truck.no_hp LIKE '%" . $searchValue . "%'";
        }
        $baseQuery = "SELECT * FROM truck".$whereClause." LIMIT $start, $length";
        $query = $db->query($baseQuery);
        $truck = $query->getResult();
        $truckList = array();
        $num = 0;
        $base_url = base_url();
        foreach($truck as $tr){
            $num+=1;
            $truckList[] = array(
                $num,
                $tr->plat,
                $tr->supir,
                $tr->no_hp,
                $tr->garasi,
                "<td ><button data-toggle='modal' onclick='getTruck($tr->id)' data-target='#editModal' class='bgc-primary w-12 h-10 textc-secondary mr-2'><icon class='fa fa-pen-to-square'></icon></button><button onclick='window.location.href = \"{$base_url}/delete-truck/{$tr->id}\"' class='w-12 h-10 bg-red-500 text-white'><icon class='fa fa-trash'></icon></button></td>"
            );
        }
        $record['data'] = $truckList;
        $record['recordsTotal'] = count($truckList);
        $record['recordsFiltered'] = $this->countAllRecords();
        return json_encode($record);
    }
    public function countAllRecords() {
        $db = db_connect();
        $query = $db->query("SELECT COUNT(*) AS total FROM truck");
        $result = $query->getRow();
        return $result->total;
    }
    public function surat()
    {   
        $db = db_connect();
        $searchValue = $this->request->getVar('search')['value'] ?? '';
        $start = $this->request->getVar('start') ?? 0;  // Default to 0 if not set
        $length = $this->request->getVar('length') ?? 10;  // Default to 10 if not set
        // Initialize the WHERE clause
        $whereClause = "";
        if (!empty($searchValue)) {
            // Ensure proper escaping and add wildcards for the LIKE comparison
            $searchValue = $db->escapeLikeString($searchValue);
            $whereClause = " WHERE truck.plat LIKE '%" . $searchValue . "%'" .
                        " OR truck.supir LIKE '%" . $searchValue . "%'" .
                        " OR surat.id LIKE '%" . $searchValue . "%'";
        }
        $baseQuery = "SELECT surat.id as surat_id, surat.*,truck.* FROM surat INNER JOIN truck ON truck.id = surat.truck_id".$whereClause." LIMIT $start, $length";
        $query = $db->query($baseQuery);
        $surat = $query->getResult();
        $suratList = array();
        $num = 0;
        $base_url = base_url();
        foreach($surat as $sr){
            $num+=1;
            $suratList[] = array(
                $sr->surat_id,
                $sr->plat,
                $sr->supir,
                // $sr->tujuan,
                $this->dateFormatter($sr->jam_tanggal),
                $this->checkstatus($sr->status),
                "<td ><button data-toggle='modal' onclick='getRekapDataById($sr->surat_id)' data-target='#rekapModal' class='bgc-primary w-12 h-10 textc-secondary mr-2'><icon class='fa fa-eye'></icon></button><button onclick='window.location.href = \"{$base_url}/delete-surat/{$sr->surat_id}\"' class='w-12 h-10 bg-red-500 text-white'><icon class='fa fa-trash'></icon></button></td>"
            );
        }
        $record['data'] = $suratList;
        $record['recordsTotal'] = count($suratList);
        $record['recordsFiltered'] = $this->countAllRecordsSurat();
        return json_encode($record);
    }

    public function checkstatus($status){
        if($status == "dalam perjalanan"){
            return "<i class='fa-solid fa-circle-dot text-yellow-500'></i> ".ucwords($status);
        }else{
            return "<i class='fa-solid fa-circle-dot text-green-500'></i> ".ucwords($status);
        }
    }


    public function users(){
        $db = db_connect();
        $searchValue = $this->request->getVar('search')['value'] ?? '';
        $start = $this->request->getVar('start') ?? 0;  // Default to 0 if not set
        $length = $this->request->getVar('length') ?? 10;  // Default to 10 if not set
        // Initialize the WHERE clause
        $whereClause = "";
        if (!empty($searchValue)) {
            // Ensure proper escaping and add wildcards for the LIKE comparison
            $searchValue = $db->escapeLikeString($searchValue);
            $whereClause = " WHERE truck.plat LIKE '%" . $searchValue . "%'" .
                        " OR truck.supir LIKE '%" . $searchValue . "%'" .
                        " OR surat.id LIKE '%" . $searchValue . "%'";
        }
        $baseQuery = "SELECT * FROM users".$whereClause." LIMIT $start, $length";
        $query = $db->query($baseQuery);
        $surat = $query->getResult();
        $suratList = array();
        $num = 0;
        $base_url = base_url();
        foreach($surat as $sr){
            $num+=1;
            $suratList[] = array(
                $sr->nama,
                $sr->username,
                //$sr->password,
                $this->userType($sr->tipe),
                "<td ><button data-toggle='modal' onclick='getUserById($sr->id)' data-target='#editModal' class='bgc-primary w-12 h-10 textc-secondary mr-2'><icon class='fa fa-pen-to-square'></icon></button><button onclick='window.location.href = \"{$base_url}/delete-users/{$sr->id}\"' class='w-12 h-10 bg-red-500 text-white'><icon class='fa fa-trash'></icon></button></td>"
            );
        }
        $record['data'] = $suratList;
        $record['recordsTotal'] = count($suratList);
        $record['recordsFiltered'] = $this->countAllRecordsUsers();
        return json_encode($record);
    }

    public function userType($tipe){
        if($tipe == '1'){
            return "Super Admin";
        }
        if($tipe == '2'){
            return "Admin";
        }
        if($tipe == '3'){
            return "Checker";
        }
    }

    public function dateFormatter($date){
        $date_obj = new DateTime($date);
        return $date_obj->format('d-m-Y  H:i');

    }
    public function countAllRecordsSurat() {
        $db = db_connect();
        $query = $db->query("SELECT COUNT(*) AS total FROM surat");
        $result = $query->getRow();
        return $result->total;
    }
    public function countAllRecordsUsers() {
        $db = db_connect();
        $query = $db->query("SELECT COUNT(*) AS total FROM users");
        $result = $query->getRow();
        return $result->total;
    }
   
}
