<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Kategori',
            'kategori' => $this->kategoriModel->findAll()  
        ];

        return view('kategori/kategori', $data); 
    }

    public function create()
    {
        return view('kategori/kategori_create');
    }

    public function save()
    {
        $model = new KategoriModel();

        $data = [
            'id_kategori' => $this->request->getPost('id_kategori'),
            'nm_kategori' => $this->request->getPost('nm_kategori'),
        ];

        $model->insert($data);

        return redirect()->to('kategori/kategori');
    }

    public function edit($id_kategori)
    {
        $kategori = $this->kategoriModel->find($id_kategori);

        if (!$kategori) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kategori dengan ID $id_kategori tidak ditemukan");
        }

        $data = [
            'title' => 'Edit Kategori',
            'kategori' => $kategori
        ];

        return view('kategori/kategori_update', $data);
    }

    public function update($id_kategori)
    {
        if (!$this->validate([
            'nm_kategori' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('message', 'Data kategori tidak valid.');
        }

        $nm_kategori = $this->request->getPost('nm_kategori');

        $this->kategoriModel->update($id_kategori, [
            'nm_kategori' => $nm_kategori,
        ]);

        return redirect()->to('kategori/kategori')->with('message', 'Kategori berhasil diperbarui!');
    }

    public function delete($id_kategori)
    {
        $kategori = $this->kategoriModel->find($id_kategori);

        if (!$kategori) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kategori dengan ID $id_kategori tidak ditemukan");
        }

        $this->kategoriModel->delete($id_kategori);

        return redirect()->to('kategori/kategori')->with('message', 'Kategori berhasil dihapus!');
    }
}
