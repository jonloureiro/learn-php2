<?php
namespace MinhasHoras\Services\Tokens;

use Exception;
use MinhasHoras\Lib\Base;
use MinhasHoras\Services\Users\User;

class Token extends Base
{
    public function loginWithEmail()
    {
        $user = User::get(['email' => "$this->email"], 'email, password', 1);
        if (!empty($user)) {
            if (password_verify($this->password, $user->password)) {
                return $user;
            }
        }
        throw new Exception("SERVICES/TOKENS");
    }
}
