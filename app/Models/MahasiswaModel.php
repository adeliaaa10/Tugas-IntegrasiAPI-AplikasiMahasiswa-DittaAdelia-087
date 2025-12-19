<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    // 1. Pastikan nama tabel SESUAI dengan di phpMyAdmin
    protected $table            = 'mahasiswa'; 
    
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    // 2. Wajib diisi kolom apa saja yang boleh di-input lewat API
    protected $allowedFields    = ['nama', 'nim', 'jurusan']; 
}