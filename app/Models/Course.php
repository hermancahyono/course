<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'slug',
        'category_id',
        'user_id',
        'demo',
        'description',
        'discount',
        'price'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function videos(){
        return $this->hasMany(Video::class);
    }
    
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
