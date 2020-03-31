<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Registration extends Model
{
     protected $table = 'registration';
     protected $primaryKey = 'r_id';
     public $timestamps = false;

     protected $fillable = [
     	's_id', 'c_id','child_name','phone','allergy_info','notes','age'
     ];

     public function child()
     {
     	return Child::find($this->c_id);
     }

     public function session()
     {
     	return Session::find($this->s_id);
     }

     public function children()
     {
          return DB::table('child')
                    ->join('registration','child.c_id','=','registration.c_id')
                    ->where('registration.s_id','=',$this->s_id)
                    ->select('child.child_name','registration.r_id')
                    ->get();
     }

     public static function store($children, $request){

        // retrieve session and its classList
        $r_id = -1;
        $session = Session::find(request('s_id'));
        $classList = $session->registration();
        $list=array();
        foreach($classList as $child){
            $list[]=$child->c_id;
        }

        $errors=array();
        $success = 'Successfully registered';

        foreach($children as $child){
            $child->child_name = decrypt($child->child_name);
            // get the c_id passed through the request. Store as id
            $id = request($child->c_id);

            // if the request c_id has a value (ie checked) check age constraints
            if(request($id) == $id) {
                $child->age=(int)((new DateTime($child->birthdate))->diff(new DateTime())->y);

                // check that child is within the age constraints
                if(($child->age > $session->max_age) || ($child->age < $session->min_age))
                     $errors[] = "$child->child_name could not be registered because (s)he is not within the age limits for this session ($session->min_age to $session->max_age)";

                // check that session is not full
                elseif($session->is_full == 't')
                    $errors[] ="This session is now full. $child->child_name could not be registered";

                // check if child is already registered in the class
                elseif(in_array($child->c_id, $list))
                   $errors[] = "$child->child_name is already registered in this session";

                // if no validation failures, register child
                else{
                    $registration = Registration::create([
                        's_id'=>request('s_id'),
                        'c_id'=>$child->c_id,
                    ]);

                    // add child's name to success message
                    $success = $success . ", $child->child_name";

                    $r_id = $registration->r_id;
                    $num_registered = count($session->registration());

                    // update isFull status for session
                    if ($num_registered >= $session->max_attendance){
                        $session->is_full='t';
                        $session->save();
                    }
                }
            }
        }
        if ($r_id == -1)
            return back()->withErrors($errors);
        $request->session()->flash('success', $success);
        return redirect()->route('registration.show',[$r_id])->withErrors($errors);

    }

}
