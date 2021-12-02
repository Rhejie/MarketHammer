<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TwilioLog extends Model
{

    const CHAT_CHANNEL_TYPE = "CHAT_CHANNEL_TYPE";

    protected $fillable = [
        'log_type',
        'log_id',
        'user_id',
    ];
}
