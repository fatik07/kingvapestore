<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $fillable = ['photos','products_id'];
    protected $hidden = [];

    // relasi dari model galeryproduct ke model product
    public function product()
    {
        // banyak galery dimiliki satu product(nama class, local key dari gallery, id dari product sendiri)
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
