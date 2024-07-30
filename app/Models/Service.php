<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'unsignedBigInteger';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            $service->id = DB::select("SELECT UUID_SHORT() as id")[0]->id;
        });
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }

    public function detail_service()
    {
        return $this->hasMany(DetailService::class, 'id_service');
    }

    public function notifikasi()
    {
        return $this->hasOne(Notifikasi::class, 'id_service');
    }
}
