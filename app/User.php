<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        return $this->hasOne('App\Student');
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

}
