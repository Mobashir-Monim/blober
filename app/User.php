<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use App\SessionCode as SC;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $appends = ['last_activity', 'member_since'];

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

    /**
     * Relationship Functions
    */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function student()
    {
        return $this->hasOne('App\Student', 'user_id');
    }

    public function authCodes()
    {
        return $this->hasMany('App\SessionCode');
    }

    public function sets()
    {
        return $this->hasMany('App\QuizSet');
    }

    public function quizAttempts()
    {
        return $this->hasMany('App\QuizAttempt');
    }

    public function sections()
    {
        return $this->belongsToMany('App\Section');
    }

    /**
     * Validator Functions
    */

    public static function storeValidator()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'exists:roles,id']
        ];
    }

    /**
     * Custom Functions
    */

    public function hasRole($roleName)
    {
        foreach ($this->roles as $role) {
            if ($role->name == $roleName)
                return true;
        }

        return false;
    }

    public function highestRole()
    {
        return $this->roles->sortByDesc('level')->first();
    }

    public static function generatePassword()
    {
        $pass = '';
        $chars = [
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
        ];

        for ($i = 0; $i < 10; $i++) {
            $pass .= $chars[rand(0, 61)];
        }

        return $pass;
    }

    public static function getUser($code)
    {
        return SC::where('code', $code)->first()->user;
    }

    public function getAuth()
    {
        $auth = $this->authCodes()->where('user_id', $this->id)->where('expires_at', '>', Carbon::now()->toDateTimeString())->orderBy('created_at', 'DESC')->first();
        $auth->expires_at = Carbon::now()->addMinutes(30)->toDateTimeString();
        $auth->save();

        return $auth->code;
    }

    public function getlastActivityAttribute()
    {
        $now = Carbon::now();
        $expiration = SC::where('user_id', $this->id)->orderBy('created_at', 'DESC')->first();
        
        if (!is_null($expiration)) {
            $expiration = Carbon::parse($expiration->expires_at);

            if ($expiration > $now) {
                return 'Session ongoing';
            } elseif ($now->diffInDays($expiration) >= 1) {
                return  $now->diffInDays($expiration) . ($now->diffInDays($expiration) == 1 ? ' day' : ' days' .' ago');
            } elseif ($now->diffInHours($expiration) >= 1) {
                return $now->diffInHours($expiration) . ($now->diffInHours($expiration) == 1 ? ' hour' : ' hours' .' ago');
            } else {
                return $now->diffInMinutes($expiration) .( $now->diffInMinutes($expiration) == 1 ? ' minute' : ' minutes' .' ago');
            }
        }

        return 'Account never logged into';
    }

    public function getMemberSinceAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M, Y');
    }

    public function sectionAuthorized($section)
    {
        if ($this->hasRole('developer') || $this->hasRole('lab-coordinator') || !is_null($this->sections->where('id', $section)->first()))
            return true;

        return false;
    }
}
