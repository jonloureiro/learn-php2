<?php
namespace MinhasHoras\Config;

class Locale
{
    public static function set()
    {
        date_default_timezone_set('America/Cuiaba');
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
    }
}
