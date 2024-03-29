<?php

namespace App\Models;

use Dotenv\Util\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Funko extends Model
{
    use HasFactory;
    protected $table = 'funkos';
    public static string $IMAGE_DEFAULT = 'https://via.placeholder.com/150';


    protected $fillable = ['name', 'price', 'stock', 'image', 'category_id', 'is_deleted'];


    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', "%$search%");
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
