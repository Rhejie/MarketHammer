<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TwilioPayload extends Model
{
    protected $fillable = [
        'payload',
        'twilio_log_id'
    ];
}
