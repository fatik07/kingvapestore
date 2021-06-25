<?php

namespace App;

use App\User;
use App\Category;
use App\ProductGallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','users_id','categories_id','price','description','slug'];

    protected $hidden = [];

    // relasi dari model product ke model productgallery
    public function galleries()
    {
        // satu procduct memiliki banyak galery product(nama class, local key, id dari product sendiri)
        return $this->hasMany(ProductGallery::class, 'products_id', 'id');
    }

    // relasi dari model product ke model user
    public function user()
    {
        // satu product memiliki 1 user (nama class, local key, foreign key)
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    // relasi dari model product ke model category
    public function category()
    {
        // kategori dimiliki oleh 1 product (nama class, local key, id dari product)
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }
}
