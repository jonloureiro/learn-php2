<?php

namespace MinhasHoras\Config;

use MinhasHoras\Lib\SingletonTrait;

class Locale
{
    use SingletonTrait;

    public static function set()
    {
        date_default_timezone_set('America/Cuiaba');
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
    }
}
