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
}