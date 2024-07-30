<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pelanggan;
use App\Models\Service;

class Kendaraan extends Model
{
    protected $guarded = [];
    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class,'id_pelanggan');
    }
    public function service(){
        return $this->hasMany(Service::class,'id_kendaraan');
    }
    use HasFactory;
}
