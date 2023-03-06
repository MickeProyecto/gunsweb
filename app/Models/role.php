<?php

namespace App\Models;

use App\Models\user;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class role extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable = [
        'id',
        'role'
    ];
    public function user(){
        return $this->belongsTo(user::class);
    }
}
