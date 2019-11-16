<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\QuestionCategory;
use App\User;
use App\Answer;

class Question extends Model
{
   protected $fillable = [
   	'title', 'body'
   ];

   protected $with = [ "category", "author" ];

   public function category()
   {
   	return $this->belongsTo(QuestionCategory::class, 'category_id');
   }

   public function answers()
   {
      return $this->hasMany(Answer::class, 'question_id');
   }

   public function author()
   {
   	return $this->belongsTo(User::class, 'author_id');
   }
}
