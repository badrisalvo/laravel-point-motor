<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'users';
    
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role', 
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Set the primary key type and disable auto increment
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'unsignedBigInteger';

    // Boot method to generate UUID_SHORT for id
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->id = DB::select("SELECT UUID_SHORT() as id")[0]->id;
        });
    }

    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class, 'id_user');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
