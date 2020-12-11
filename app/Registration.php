<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Registration extends Model
{
     protected $table = 'registration';

     protected $fillable = [
     	'session_id', 'child_id','child_name','phone','allergy_info','notes','age'
     ];

     public function child()
     {
     	return Child::find($this->child_id);
     }

     public function session()
     {
     	return $this->belongsTo('App\Session');
     }

     public function children()
     {
          return DB::table('child')
                    ->join('registration','child.id','=','registration.child_id')
                    ->where('registration.session_id','=',$this->session_id)
                    ->select('child.name','registration.id')
                    ->get();
     }

     public static function store($children, $request){

        // retrieve session and its classList
        $registration_id = -1;
        $session = Session::find($request->session_id);
        $classList = $session->registrations;
        $list = array();
        foreach($classList as $child){
            $list[]=$child->id;
        }

        $errors = array();
        $success = 'Successfully registered';

        foreach($children as $child){
            $child->name = decrypt($child->name);
            // get the c_id passed through the request. Store as id
            $id = request($child->id);

            // if the request c_id has a value (ie checked) check age constraints
            if(request($id) == $id) {
                $child->age=(int)((new DateTime($child->birthdate))->diff(new DateTime())->y);

                // check that child is within the age constraints
                if(($child->age > $session->max_age) || ($child->age < $session->min_age))
                     $errors[] = "$child->name could not be registered because (s)he is not within the age limits for this session ($session->min_age to $session->max_age)";

                // check that session is not full
                elseif($session->is_full == 't')
                    $errors[] ="This session is now full. $child->name could not be registered";

                // check if child is already registered in the class
                elseif(in_array($child->id, $list))
                   $errors[] = "$child->name is already registered in this session";

                // if no validation failures, register child
                else{
                    $registration = Registration::create([
                        'session_id'=>$request->session_id,
                        'child_id'=>$child->id,
                    ]);

                    // add child's name to success message
                    $success = $success . ", $child->name";

                    $registration_id = $registration->id;
                    $num_registered = count($session->registrations);

                    // update isFull status for session
                    if ($num_registered >= $session->max_attendance){
                        $session->is_full = true;
                        $session->save();
                    }
                }
            }
        }
        if ($registration_id == -1)
            return back()->withErrors($errors);
        $request->session()->flash('success', $success);
        return redirect()->route('registration.show',[$registration_id])->withErrors($errors);

    }

}
