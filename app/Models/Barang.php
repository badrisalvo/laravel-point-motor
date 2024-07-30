<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\DetailService;

class Barang extends Model
{
    protected $guarded = [];
    public function kategori(){
        return $this->belongsTo(Kategori::class,'id_kategori');
    }
    public function detail_service(){
        return $this->hasMany(DetailService::class,'id_barang');
    }
    use HasFactory;
}
