<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    // menghapus sementara seperti recycle bin
    use SoftDeletes;

    // field apa aja yang diberbolehkan
    protected $fillable = ['name','photo','slug'];
    // fields yang tidak diperbolehkan
    protected $hidden = [];
}
