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


    public function child()
    {
        return Child::get()->where('f_id',$this->id);
    }

    public function registrations()
    {
        return DB::table('child')
            ->join('registration','registration.c_id','child.c_id')
            ->join('family','family.f_id','child.f_id')
            ->join('session','session.s_id','registration.s_id')
            ->where('family.f_id', $this->f_id)
            ->select('child.*','session.*','registration.*')
            ->get();
    }
}
