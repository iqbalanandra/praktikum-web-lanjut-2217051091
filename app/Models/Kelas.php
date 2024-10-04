<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    public function getKelas()
    {
        return $this->all();
    }

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany(UserModel::class, 'kelas_id');
    }
}
