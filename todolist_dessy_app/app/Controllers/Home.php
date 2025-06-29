<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        //$home = new InputListModels();
        //$data['title'] = $home->findAll();
        //echo view('welcome_message');
        //echo view('welcome_message',$data);
        return view('welcome_message');
    }
    public function tambah()
    {
        //lakukan validasi
        $validation = \Config\Services::validation();
        $validation ->setRules(['title' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
        //jika data valid, simpan ke database
        if($isDataValid){
            $home = new InputListModels();
            $home->insert([
                "title"=>$this->request->getPost('title')]);
            return redirect('inputlist');
        }
        echo view('welcome_message');
    }
    public function edit($id)
    {
        //ambil artikel yang akan diedit
        $home = new InputListModels();
        $data['inputlist'] = $home->where('id_kategori', $id)->first();
        //lakukan validasi data artikel
        $validation = \Config\Services::validation();
        $validation ->setRules(['title' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
        //jika data valid, simpan ke database
        if($isDataValid){
            $home->update($id,[
                "title"=>$this->request->getPost('title')]);
            return redirect('inputlist');
        }
        echo view('welcome_message');
    }
    public function delete($id)
    {
        $home = new InputListModels();
        $home->delete($id);
        return redirect('inputlist');
    }
}
