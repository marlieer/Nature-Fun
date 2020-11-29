<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name','email', 'password', 'phone','id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function children()
    {
        return $this->hasMany('App\Child', 'user_id', 'id');
    }

    public function registrations()
    {
        return DB::table('child')
            ->join('registration','registration.child_id','child.id')
            ->join('users','users.id','child.user_id')
            ->join('session','session.id','registration.session_id')
            ->where('users.id', $this->id)
            ->select('child.*','session.*','registration.*')
            ->get();
    }

    public function isAdmin()
    {
        return $this->isAdmin;
    }
}
