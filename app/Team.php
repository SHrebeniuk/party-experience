<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Team extends Model
{
   protected $fillable = [
      'title', 'description', 'subdescription', 'image_url'
   ];

   protected $with = [ "owner" ];

   public function owner()
   {
      return $this->belongsTo(User::class, 'user_id');
   }

   public function users()
    {
      return $this->belongsToMany(User::class, 'team_users', 'team_id', 'user_id');
    }
}
