<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLinks extends Model
{
    protected $table = 'user_links';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'status',
        'link',
        'expired_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
