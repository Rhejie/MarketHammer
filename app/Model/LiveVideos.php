<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LiveVideos extends Model
{
    use SoftDeletes;

    protected $table = 'livevideos';

    protected $fillable = ['businessListID', 'url', 'caption'];
}
