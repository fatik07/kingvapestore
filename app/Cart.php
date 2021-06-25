<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['products_id', 'users_id'];

    protected $hidden = [''];

    // relasi ke product
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'products_id');
    }

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    
}
