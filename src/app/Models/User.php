<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'phonenumber'
    ];

    public function links()
    {
        return $this->hasMany(UserLinks::class, 'user_id');
    }
}
