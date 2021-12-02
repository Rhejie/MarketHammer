<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['user_id', 'message'];

    public function user()
    {

        return $this->belongsTo(User::class);

    }
}
