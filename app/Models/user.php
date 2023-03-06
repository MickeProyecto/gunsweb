<?php

namespace App\Models;

use App\Models\role;
use App\Models\pedidos;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\user as Authenticatable;


class user extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps=false;
    protected $fillable = [
        'id',
        'name',
        'lastName',
        'phone',
        'photo',
        'date_birth',
        'direccion',
        'email',
        'password',
        'id_role'
    ];
    public function role(){
        return $this->belongsTo(role::class);
    }
    public function pedidos(){
        return $this->belongsTo(pedidos::class);
    }
}
