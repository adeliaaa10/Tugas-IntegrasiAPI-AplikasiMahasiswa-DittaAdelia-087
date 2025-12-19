<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Mahasiswa extends ResourceController
{
    protected $modelName = 'App\Models\MahasiswaModel';
    protected $format    = 'json';

    // 1. SELECT (Menampilkan semua data) -> GET
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    // 2. INSERT (Menambah data) -> POST
    public function create()
    {
        $data = [
            'nama' => $this->request->getVar('nama'),
            'nim'  => $this->request->getVar('nim'),
            'jurusan' => $this->request->getVar('jurusan'),
        ];
        
        $this->model->insert($data);
        
        $response = [
            'status'   => 201,
            'messages' => 'Data berhasil ditambahkan'
        ];
        return $this->respondCreated($response);
    }

    // 3. UPDATE (Mengubah data) -> PUT
    public function update($id = null)
    {
        $input = $this->request->getRawInput(); // Mengambil data PUT/PATCH
        $data = [
            'nama' => $input['nama'] ?? null,
            'nim'  => $input['nim'] ?? null,
            'jurusan' => $input['jurusan'] ?? null,
        ];

        // Hapus data yang kosong agar tidak menimpa dengan null
        $data = array_filter($data); 

        if ($this->model->find($id)) {
            $this->model->update($id, $data);
            return $this->respond(['messages' => 'Data berhasil diupdate']);
        }

        return $this->failNotFound('Data tidak ditemukan');
    }

    // 4. DELETE (Menghapus data) -> DELETE
    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            $this->model->delete($id);
            return $this->respondDeleted(['messages' => 'Data berhasil dihapus']);
        }
        return $this->failNotFound('Data tidak ditemukan');
    }
}