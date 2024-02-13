<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['uuid', 'name', 'is_deleted'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->uuid = Str::uuid();
        });
    }

    public function funkos()
    {
        return $this->hasMany(Funko::class);
    }

}
