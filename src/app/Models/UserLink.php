<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLink extends Model
{
    protected $table = 'user_links';
    public $timestamps = true;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

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
