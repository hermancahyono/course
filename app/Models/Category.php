<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
    ];

    //add accesor methods

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('storage/categories/' . $this->$image),
        );
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }
}
