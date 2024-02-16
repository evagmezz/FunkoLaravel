<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'categories';
    protected $fillable = ['id', 'name', 'is_deleted'];


    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'LIKE', "%$search%");
        }
    }

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
