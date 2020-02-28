<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\SessionCode as SC;
use App\User;

class AuthCodeHelper extends Helper
{
    protected $user = null;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function generateAuth()
    {
        $auth = SC::getAuth('user_id', $this->user->id);

        if (!is_null($auth)) {
            $auth->expires_at = Carbon::now()->addMinutes(30);
            $auth->save();

            return $auth->code;
        }

        return $this->computeAuth()->code;
    }

    public function computeAuth()
    {
        $nonce = 0;
        $hash = hash('sha256', json_encode(['nonce' => $nonce, 'user' => $this->user]));

        while (!is_null(SC::isValidHash($hash))) {
            $nonce++;
            $hash = hash('sha256', json_encode(['nonce' => $nonce, 'user' => $this->user]));
        }
        
        return SC::create(['user_id' => $this->user->id, 'code' => $hash, 'nonce' => $nonce, 'expires_at' => Carbon::now()->addMinutes(30)->toDateTimeString()]);
    }
}