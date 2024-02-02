<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Auth extends model
{
    use HasFactory;

    protected $model = 'auths';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'email', 'password'
    ];

    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }
}
