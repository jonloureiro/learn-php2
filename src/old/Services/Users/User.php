<?php

namespace MinhasHoras\Services\Users;

use MinhasHoras\Lib\Entity;

class User extends Entity
{
    protected static $tableName = 'user';
    protected static $columns = [
      'id',
      'name',
      'password',
      'email',
      'start_date',
      'end_date',
      'is_admin'
    ];

    public function unsetPassword()
    {
        if (array_key_exists('password', $this->values)) {
            unset($this->values['password']);
        }
    }

    public function unsetEndDate()
    {
        if (array_key_exists('end_date', $this->values)) {
            unset($this->values['end_date']);
        }
    }
}
