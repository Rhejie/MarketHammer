<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SocialMediaAccount extends Model
{
  protected $fillable = ['user_id', 'provider_user_id', 'provider'];

  public function user()
  {
      return $this->belongsTo(User::class, 'user_id', 'id');
  }
}
