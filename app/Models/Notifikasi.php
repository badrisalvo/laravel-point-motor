<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_service',
        'remind_at',
    ];

    protected $dates = [
        'remind_at',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }

    // Other methods...
}
