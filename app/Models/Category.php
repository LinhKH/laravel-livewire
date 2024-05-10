<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image', 'meta_title', 'meta_keyword', 'meta_description', 'status'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
