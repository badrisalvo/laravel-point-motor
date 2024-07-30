<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // Gunakan $fillable atau $guarded tergantung pada preferensi Anda
    protected $fillable = [
        'nama',
        'no_hp',
        'alamat',
        'id_user' // tambahkan semua atribut yang diizinkan untuk diisi
    ];

    // Relasi ke model Kendaraan
    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class, 'id_pelanggan');
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
