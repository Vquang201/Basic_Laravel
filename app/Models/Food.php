<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Food extends Model
{
    use HasFactory;

    protected $model = 'food';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name', 'count', 'description',
        'image_path', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
