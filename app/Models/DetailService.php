<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
use App\Models\Service;

class DetailService extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }
}
