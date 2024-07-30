<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
use App\Models\Jasa;

class kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = [
        'nama_kategori'
    ];
    public function barang(){
        return $this->hasMany(Barang::class,'id_kategori');
    }
    public function jasa(){
        return $this->hasMany(Jasa::class,'id_kategori');
    }

}
