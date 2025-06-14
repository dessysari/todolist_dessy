<?php

namespace App\Controllers;

use App\Models\InputListModels;
use CodeIgniter\Exceptions\PageNotFoundException;
//use CodeIgniter\Controller;

class InputList extends BaseController
{
    public function index()
    { 
        $inputlist = new InputListModels();
        $data['kat'] = $inputlist->findAll();
        echo view('inputlist',$data);
    }
    public function tambah()
    {
        //lakukan validasi
        $validation = \Config\Services::validation();
        $validation ->setRules(['title' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
        //jika data valid, simpan ke database
        if($isDataValid){
            $kat = new InputListModels();
            $kat->insert([
                "title"=>$this->request->getPost('title')]);
            return redirect('inputlist');
        }
        echo view('welcome_message');
    }
    public function edit($id)
    {
        //ambil artikel yang akan diedit
        $kat = new InputListModels();
        $data['inputlist'] = $kat->where('id_kategori', $id)->first();
        //lakukan validasi data artikel
        $validation = \Config\Services::validation();
        $validation ->setRules(['title' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
        //jika data valid, simpan ke database
        if($isDataValid){
            $kat->update($id,[
                "title"=>$this->request->getPost('title')]);
            return redirect('inputlist');
        }
        echo view('welcome_message');
    }
    public function delete($id)
    {
        $kat = new InputListModels();
        $kat->delete($id);
        return redirect('inputlist');
    }
}

