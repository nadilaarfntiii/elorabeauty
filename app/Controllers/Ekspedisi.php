<?php

namespace App\Controllers;

use App\Models\EkspedisiModel;

use App\Controllers\BaseController;

class Ekspedisi extends BaseController
{
    public function kelola_ekspedisi()
    {
        $model = new EkspedisiModel();

        $data['ekspedisi'] = $model->findAll(); 
        
        return view('ekspedisi/kelola_ekspedisi', $data);
    }

    public function create()
    {
        return view('ekspedisi/ekspedisi_create');
    }

    public function save()
    {
        $model = new EkspedisiModel();

        $data = [
            'id_ekspedisi' => $this->request->getPost('id_ekspedisi'),
            'nama_ekspedisi' => $this->request->getPost('nama_ekspedisi'),
            'estimasi_pengiriman' => $this->request->getPost('estimasi_pengiriman'),
            'tarif_pengiriman' => $this->request->getPost('tarif_pengiriman'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status' => $this->request->getPost('status')
        ];

        if ($model->insert($data)) {
            session()->setFlashdata('new_ekspedisi', 'Ekspedisi berhasil ditambahkan.');
        } else {
            session()->setFlashdata('errors', $model->errors());
        }

        return redirect()->to('ekspedisi/kelola_ekspedisi');
    }

    public function edit($id_ekspedisi)
    {
        $model = new EkspedisiModel();

        $ekspedisi = $model->find($id_ekspedisi);
        if (!$ekspedisi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Ekspedisi dengan ID $id_ekspedisi tidak ditemukan");
        }

        $data = [
            'title' => 'Edit Ekspedisi',
            'ekspedisi' => $ekspedisi
        ];

        return view('ekspedisi/ekspedisi_update', $data);
    }

    public function update($id_ekspedisi)
    {
        $model = new EkspedisiModel();
    
        if (!$this->validate([
            'nama_ekspedisi' => 'required|string|max_length[100]',
            'estimasi_pengiriman' => 'permit_empty|string|max_length[50]',
            'tarif_pengiriman' => 'required|decimal',
            'no_hp' => 'permit_empty|string|max_length[50]',
            'status' => 'required|in_list[Aktif,Nonaktif]',
        ])) {
            return redirect()->back()->withInput()->with('message', 'Data ekspedisi tidak valid.');
        }
    
        $nama_ekspedisi = $this->request->getPost('nama_ekspedisi');
        $estimasi_pengiriman = $this->request->getPost('estimasi_pengiriman');
        $tarif_pengiriman = $this->request->getPost('tarif_pengiriman');
        $no_hp = $this->request->getPost('no_hp');
        $status = $this->request->getPost('status');
    
        $model->update($id_ekspedisi, [
            'nama_ekspedisi' => $nama_ekspedisi,
            'estimasi_pengiriman' => $estimasi_pengiriman,
            'tarif_pengiriman' => $tarif_pengiriman,
            'no_hp' => $no_hp,
            'status' => $status,
        ]);
    
        return redirect()->to('ekspedisi/kelola_ekspedisi')->with('message', 'Ekspedisi berhasil diperbarui!');
    }

    public function delete($id_ekspedisi)
    {
        $model = new EkspedisiModel();
        $ekspedisi = $model->find($id_ekspedisi);
        if (!$ekspedisi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Ekspedisi dengan ID $id_ekspedisi tidak ditemukan.");
        }

        $model->delete($id_ekspedisi);
        return redirect()->to('ekspedisi/kelola_ekspedisi')->with('pesan', 'Data ekspedisi berhasil dihapus.');
    }


    public function pilih($ekspedisi)
    {
        session()->setFlashdata('selectedShipping', $ekspedisi);
        return redirect()->to('/checkout');
    }
}
