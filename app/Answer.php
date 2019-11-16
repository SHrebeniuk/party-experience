<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
    	'body'
    ];

    protected $with = [ "author" ];

    public function author()
   {
      return $this->belongsTo(User::class, 'author_id');
   }
}
