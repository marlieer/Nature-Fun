<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Session extends Model
{
     protected $table = 'session';
     protected $primaryKey = 's_id';
     public $timestamps = false;

     protected $fillable = [
     	'title', 'date', 'start_time', 'end_time','max_attendance', 'min_age', 'max_age'
     ];

     public function registration()
     {
     	return Registration::get()->where('s_id',$this->s_id);
     }

     public function spotsAvailable()
     {
          return $this->max_attendance - count($this->registration());
     }

     // children registered for a session but not signed up in the system
     public function childrenNotInTheSystem()
     {
          return Registration::where('s_id',$this->s_id)
                ->whereNull('c_id')
                ->get();
     }

     // children registered for a session and signed up in the system
     public function childrenInTheSystem()
     {
          return DB::table('child')
            ->join('registration','child.c_id','=','registration.c_id')
            ->join('family','child.f_id','=','family.f_id')
            ->where('registration.s_id',$this->s_id)
            ->select('child.*','registration.r_id','registration.c_id','registration.is_paid','registration.s_id','family.phone','family.last_name')
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
        $num_registered = count($this->registration());
        if ($num_registered >= $this->max_attendance){
            $this->is_full='t';
            $this->save();
        }
        else {
            $this->is_full = 'f';
            $this->save();
        }
     }
}
