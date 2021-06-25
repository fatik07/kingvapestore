<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id', 'inscurance_price','transaction_status', 'shipping_price', 'total_price', 'code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // none
    ];

    public function user()
    {
        // (nama class, foreign key, local key)
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
