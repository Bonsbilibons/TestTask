<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameHistory extends Model
{
    protected $table = 'games_history';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'result',
        'score',
        'sum_of_win',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
