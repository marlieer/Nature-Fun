<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
     protected $table = 'child';

      protected $fillable = [
     	'name', 'allergy_info', 'notes','birthdate','user_id', 'can_take_photos'
     ];


      public function family()
      {
          $this->user();
      }


     public function registration()
     {
     	return $this->hasMany('App\Registration');
     }

     public function user()
     {
          $this->belongsTo('App\User', 'user_id', 'id');
     }

     public function age()
     {
          return (new DateTime($this->birthdate))->diff(new DateTime())->y;
     }
}
