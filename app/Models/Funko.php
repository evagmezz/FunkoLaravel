<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funko extends Model
{
    protected $table = 'funkos';
    public static string $IMAGE_DEFAULT = 'https://via.placeholder.com/150';


    protected $fillable = ['name', 'price', 'stock', 'image', 'category_id', 'is_deleted'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
