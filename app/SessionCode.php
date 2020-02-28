<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SessionCode extends BaseModel
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function getAuth($col, $val)
    {
        return self::where($col, $val)->where('expires_at', '>', Carbon::now()->toDateTimeString())->orderBy('created_at', 'DESC')->first();
    }

    public static function isValidHash($hash)
    {
        return self::where('code', $hash)->first();
    }
}
