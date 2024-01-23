<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $model = 'categories';
    protected $primaryKey = 'id';

    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
