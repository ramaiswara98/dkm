<?php

namespace App\Controllers;

use App\Models\SuratJalanModel;

class Admin extends BaseController
{
    public function truck(): string
    {
        $data['page'] = "truck";
        $session = session();
        $data['session'] = $session;
        return view('admin/truck',$data);
    }

    public function tambahtruck()
    {
        $data = $this->request->getVar();
        $plat = $data['plat'];
        $supir = $data['supir'];
        $no_hp = $data['no_hp'];
        $garasi = $data['garasi'];

        $db = db_connect();
        $query = $db->query("INSERT INTO truck (plat, supir, no_hp, garasi) VALUES (?, ?, ?, ?)", [$plat, $supir, $no_hp, $garasi]);
        $db->close();
        
        return redirect()->to(base_url()."/truck")->with("success","Truck Berhasil Ditambahkan");
        //return view('admin/tambahtruck',$data);
    }

    public function simpantruck(){
        $data = $this->request->getVar();
        $id = $data['id'];
        $plat = $data['plat'];
        $supir = $data['supir'];
        $no_hp = $data['no_hp'];
        $garasi = $data['garasi'];
        $db = db_connect();
        $query = $db->query("UPDATE truck SET plat = '$plat', supir = '$supir', no_hp = '$no_hp', garasi = '$garasi' WHERE id = '$id'");
        $db->close();
        
        return redirect()->to(base_url()."/truck")->with("success","Perubahan Data Truck Berhasil Disimpan");
    }

    public function deletetruck($id){
        $db = db_connect();
        $query = $db->query("DELETE FROM truck WHERE id = $id");
        $db->close();
        return redirect()->to(base_url()."/truck")->with("success","Truck Berhasil Dihapus");

    }

    public function getTruckById($id){
        $db = db_connect();
        $query = $db->query("SELECT * FROM truck WHERE id = $id");
        $truck = $query->getFirstRow();
        header('Content-Type: application/json');
        return json_encode($truck);
        exit();

    }

    public function suratjalan(){
        $db = db_connect();
        $query = $db->query("SELECT * FROM truck");
        $truckList = $query->getResult();
        $lastIdQuery = $db->query("SELECT id as id FROM surat ORDER BY id DESC LIMIT 1");
        $lastId= $lastIdQuery->getFirstRow();
        $data['last_id'] = $lastId->id;
        $data['truck'] = $truckList;
        $data['page'] = "surat-jalan";
        $session = session();
        $data['session'] = $session;
        return view('admin/suratjalan',$data);
    }

    public function tambahsuratjalan()
    {
        $data = $this->request->getVar();
        $datas['truck_id'] = $data['truck_id'];
        $datas['berat'] = $data['berat'];
        $datas['jam_tanggal'] = $data['jam_tanggal'];
        $datas['tujuan'] = $data['tujuan'];
        $datas['status'] = "dalam perjalanan";
        $suratModel = new SuratJalanModel();
        $newSuratJalan = $suratModel->create($datas);
        //var_dump($newSuratJalan);
        return redirect()->to(base_url('print-surat-jalan/'.$newSuratJalan))->with("success","Surat Jalan Berhasil Di Buat");
    }

    public function printsurat($id){
        $db = db_connect();
        $query = $db->query("SELECT surat.id as surat_id, truck.*,surat.* FROM surat INNER JOIN truck ON truck.id = surat.truck_id WHERE surat.id = $id");
        $surat = $query->getFirstRow();
        $data['page'] = "surat-jalan";
        $session = session();
        $data['session'] = $session;
        $data['surat'] = $surat;
        return view('admin/surat',$data);

    }

    public function rekapdata(){
        $session = session();
        $data['page'] = "rekap";
        $data['session'] = $session;
        return view('admin/rekap',$data);
    }

    public function users(){
        $data['page'] = "users";
        $session = session();
        $data['session'] = $session;
        return view('admin/users',$data);
    }

    public function checker(){
        $data = $this->request->getVar();
        $surat = NULL;
        if(count($data) <= 0){

        }else{
            $surat_id = $data['surat-jalan'];
            $db = db_connect();
            $query = $db->query("SELECT surat.id as surat_id, surat.*, truck.* FROM surat INNER JOIN truck ON surat.truck_id = truck.id WHERE surat.id = $surat_id");
            $result = $query->getFirstRow();
            if($result){
                $surat = $result;
            }else{
                $surat = "TIDAK";
            }
            
        }
        $data['surat'] = $surat;
        $data['page'] = "checker";
        return view('admin/checker',$data);
    }

    public function updatesurat(){
        $data = $this->request->getVar();
        $surat_id = $data['surat_id'];
        $antrian = $data['antrian'];
        $timbangan = $data['timbangan'];
        $waktu_timbang = $data['waktu'];
        $status = 'selesai';
        $db = db_connect();
        $query = $db->query("UPDATE surat SET antrian = ?, timbangan = ?, waktu_timbang = ?, status = ? WHERE id = ?", [$antrian, $timbangan, $waktu_timbang, $status, $surat_id]);
        return redirect()->to(base_url('checker'))->with("success","Surat Jalan Berhasil Di Buat");
        //var_dump($data);
    }

    public function deletesurat($id){
        $db = db_connect();
        $query = $db->query("DELETE FROM surat WHERE id = $id");
        return redirect()->to(base_url('rekap-data'))->with("success","Berhasil Menghapus Data");
    }

    public function getRekapData(){
        $data = $this->request->getVar();
        $select = $data->data_select;
        $dari = $data->dari."T00:00";
        $sampai = $data->sampai."T23:59";
        $db = db_connect();
        header('Content-Type: application/json');
        if($select == 'all'){
            $query = $db->query("SELECT surat.id as surat_id, surat.*,truck.* FROM surat INNER JOIN truck ON surat.truck_id = truck.id");
            $result = $query->getResult();

            return json_encode($result);
        }else if($select == 'berangkat'){
            $query = $db->query("SELECT surat.id as surat_id, surat.*,truck.* FROM surat INNER JOIN truck ON surat.truck_id = truck.id WHERE jam_tanggal BETWEEN '$dari' AND '$sampai'");
            $result = $query->getResult();

            return json_encode($result);
        }else{
            $query = $db->query("SELECT surat.id as surat_id, surat.*,truck.* FROM surat INNER JOIN truck ON surat.truck_id = truck.id WHERE waktu_timbang BETWEEN '$dari' AND '$sampai'");
            $result = $query->getResult();

            return json_encode($result);
        }
        //return json_encode($data->data_select);
        
        // $truck = $query->getFirstRow();
        

    }

    public function getRekapById($id){
        $db = db_connect();
        $query = $db->query("SELECT surat.id as surat_id, truck.*, surat.* FROM surat INNER JOIN truck ON surat.truck_id = truck.id WHERE surat.id = $id");
        $result = $query->getFirstRow();
        return json_encode($result);
    }

    public function deleteUser($id){
        $db = db_connect();
        $query = $db->query("DELETE FROM users WHERE id = $id");
        return redirect()->to(base_url('users'))->with("success","Berhasil Menghapus Data");

    }

    public function getUserById($id){
        $db = db_connect();
        $query = $db->query("SELECT * FROM users WHERE id = $id");
        $result = $query->getFirstRow();
        return json_encode($result);
    }
}
