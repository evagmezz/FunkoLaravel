<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['id', 'name', 'is_deleted'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->id = Str::uuid();
        });
    }

    public function funkos()
    {
        return $this->hasMany(Funko::class);
    }

}
