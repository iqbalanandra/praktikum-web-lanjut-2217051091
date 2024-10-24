<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'fakultas';  // Nama tabel yang digunakan
    protected $guarded = ['id'];    // Menetapkan kolom yang tidak boleh diisi (mass assignment)

    // Relasi ke tabel UserModel
    public function users()
    {
        return $this->hasMany(UserModel::class, 'fakultas_id'); // Relasi fakultas ke user
    }
}
