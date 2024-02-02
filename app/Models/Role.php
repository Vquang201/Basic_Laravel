<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $model = 'roles';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
