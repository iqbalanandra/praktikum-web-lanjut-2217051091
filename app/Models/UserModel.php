<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $guarded = ['id'];

    // Relasi ke tabel Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Relasi ke tabel Fakultas
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id'); // Relasi ke fakultas
    }

    // Metode untuk mendapatkan user dengan relasi ke kelas dan fakultas
    public function getUser($id = null)
    {
        if ($id != null) {
            // Mengambil data user dengan id tertentu beserta relasi ke kelas dan fakultas
            return $this->join('kelas', 'kelas.id', '=', 'user.kelas_id')
                ->join('fakultas', 'fakultas.id', '=', 'user.fakultas_id') // Relasi ke fakultas
                ->select('user.*', 'kelas.nama_kelas as nama_kelas', 'fakultas.nama_fakultas as nama_fakultas') // Ambil data fakultas
                ->where('user.id', $id)
                ->first();
        } else {
            // Mengambil semua user beserta relasi ke kelas dan fakultas
            return $this->join('kelas', 'kelas.id', '=', 'user.kelas_id')
                ->join('fakultas', 'fakultas.id', '=', 'user.fakultas_id') // Relasi ke fakultas
                ->select('user.*', 'kelas.nama_kelas as nama_kelas', 'fakultas.nama_fakultas as nama_fakultas') // Ambil data fakultas
                ->get();
        }
    }
}
