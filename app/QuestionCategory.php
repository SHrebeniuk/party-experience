<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
	protected $fillable = [
      'title', 'description', 'image_url'
   ];

   // protected $with = [ "questions" ];

   // public function questions()
   // {
   //    return $this->belongsTo(Question::class, 'category_id');
   // }
}
