<?php

namespace MinhasHoras\Services\Tokens;

use Exception;
use MinhasHoras\Lib\Base;
use MinhasHoras\Lib\Jwt;
use MinhasHoras\Services\Users\User;

class Token extends Base
{
    public function getTokenWithEmail()
    {
        $user = User::get(['email' => "$this->email"], 'id, password, end_date', 1);
        if (!empty($user)) {
            if ($user->end_date) {
                throw new Exception("SERVICES/TOKENS");
            }

            if (password_verify($this->password, $user->password)) {
                unset($user->password);
                $token = Jwt::sign([
                    'uid' => $user->id
                ]);
                return [
                    $user,
                    $token
                ];
            }
        }
        throw new Exception("SERVICES/TOKENS");
    }
}
