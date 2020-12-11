<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Session extends Model
{
     protected $table = 'session';
     public $timestamps = false;

     protected $fillable = [
     	'title', 'date', 'start_time', 'end_time','max_attendance', 'min_age', 'max_age'
     ];

     public function registrations()
     {
     	return $this->hasMany('App\Registration');
     }

     public function spotsAvailable()
     {
          return $this->max_attendance - count($this->registrations);
     }

     // children registered for a session but not signed up in the system
     public function childrenNotInTheSystem()
     {
          return Registration::where('session_id',$this->id)
                ->whereNull('child_id')
                ->get();
     }

     // children registered for a session and signed up in the system
     public function childrenInTheSystem()
     {
          return DB::table('child')
            ->join('registration','child.id','=','registration.child_id')
            ->join('users','child.user_id','=','users.id')
            ->where('registration.session_id',$this->id)
            ->select('child.*','registration.id AS registration_id','registration.child_id','registration.is_paid','registration.session_id','users.phone','users.last_name')
            ->get();
     }


     public static function createSessions($attributes, $request)
     {
        $start_date = request('session_date');
        $attributes['date']=$start_date;
        Session::create($attributes);

        if (request('end_repeat')){
            $end_repeat = new DateTime(request('end_repeat'));


            if (request('mon')=='mon'){
                $date = new DateTime($start_date);
                $date ->modify('next Monday')->format('Y-m-d');
                while($date <= $end_repeat){
                    $attributes['date']=$date;
                    Session::create($attributes);
                    $date ->modify('next Monday')->format('Y-m-d');
                }

            }

            if(request('tue')=='tue'){
                $date = new DateTime($start_date);
                $date ->modify('next Tuesday')->format('Y-m-d');
                while($date <= $end_repeat){
                    $attributes['date']=$date;
                    Session::create($attributes);
                    $date ->modify('next Tuesday')->format('Y-m-d');
                }

            }

            if(request('wed')=='wed'){
                $date = new DateTime($start_date);
                $date ->modify('next Wednesday')->format('Y-m-d');
                while($date <= $end_repeat){
                    $attributes['date']=$date;
                    Session::create($attributes);
                    $date ->modify('next Wednesday')->format('Y-m-d');
                }

            }

            if(request('thu')=='thu'){;
                $date = new DateTime($start_date);
                $date ->modify('next Thursday')->format('Y-m-d');
                while($date <= $end_repeat){
                    $attributes['date']=$date;
                    Session::create($attributes);
                    $date ->modify('next Thursday')->format('Y-m-d');
                }

            }

            if(request('fri')=='fri'){
                $date = new DateTime($start_date);
                $date ->modify('next Friday')->format('Y-m-d');
                while($date <= $end_repeat){
                   $attributes['date']=$date;
                    Session::create($attributes);
                    $date ->modify('next Friday')->format('Y-m-d');
                }
            }

        }
     }

     public function updateIsFull()
     {
        $num_registered = count($this->registrations);
        if ($num_registered >= $this->max_attendance){
            $this->is_full=true;
            $this->save();
        }
        else {
            $this->is_full = false;
            $this->save();
        }
     }
}
