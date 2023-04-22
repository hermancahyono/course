<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showcase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'title',
        'cover',
        'description'
    ];

    //add accesor methods

    public function cover(): Attribute
    {
        return Attribute::make(
            get: fn ($cover) => asset('storage/showcase/' . $this->$cover),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
