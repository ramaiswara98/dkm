<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        $data = $this->request->getVar();
        $username = $data['username'];
        $password = $data['password'];
        $db = db_connect();
        $query = $db->query("SELECT * FROM users WHERE username = '$username'");
        $result = $query->getResult();
        if(count($result) > 0){
            $u_password =  $result[0]->password;
            if(password_verify($password, $u_password)){
                $session = session();
                $session->set('id',$result[0]->id);
                $session->set('username',$result[0]->username);
                $session->set('password',$result[0]->password);
                $session->set('nama',$result[0]->nama);
                $session->set('tipe',$result[0]->tipe);
                if($result[0]->tipe == '3'){
                    return redirect()->to(base_url('checker'));
                }else{
                    return redirect()->to(base_url('truck'));
                }
               
                echo "Success";
            }else{
                return redirect()->to(base_url())->with("error","Password Salah");
                echo "Password Salah";
            }
            //var_dump($result);
        }else{
            return redirect()->to(base_url())->with("error","Akun Tidak Di temukan");
            echo "Tidak Ada";
        }
        //return view('home');
    }

    public function createuser()
    {
        $data = $this->request->getVar();
        $username = $data['username'];
        $password = $data['password'];
        $nama = $data['nama'];
        $tipe = $data['tipe'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $db = db_connect();
        $query =  $db->query("INSERT INTO users (username, password, nama, tipe) VALUES (?, ?, ?, ?)",[$username, $hashed_password,$nama, $tipe]);
        $db->close();
        return redirect()->to(base_url()."users")->with("success","Users Berhasil Ditambahkan");
    }

    public function updateUsers(){
        $data = $this->request->getVar();
        $username = $data['username'];
        $password = $data['password'];
        $id = $data['id'];
        $nama = $data['nama'];
        $tipe = $data['tipe'];
        $db = db_connect();
        if($password != ""){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query =  $db->query("UPDATE users SET username = ?, password = ?, nama = ?, tipe = ? WHERE id = ?", [$username, $hashed_password, $nama, $tipe, $id]);
            $db->close();
            return redirect()->to(base_url()."users")->with("success","Users Berhasil Ditambahkan");
        }else{
            $query =  $db->query("UPDATE users SET username = ?, nama = ?, tipe = ? WHERE id = ?", [$username, $nama, $tipe, $id]);
            $db->close();
            return redirect()->to(base_url()."users")->with("success","Users Berhasil Di Update");
        }
    }

    public function logout(){
        $session = session();
        $session->remove('username');
        $session->remove('password');
        $session->remove('name');
        $session->remove('tipe');
        $session->remove('id');
        return redirect()->to(base_url()."/");
    }
}
