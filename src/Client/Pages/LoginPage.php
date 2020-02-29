<?php

declare(strict_types=1);

namespace MinhasHoras\Client\Pages;

use League\Plates\Engine as PlatesEngine;

class LoginPage extends Page
{
    protected function render(): string
    {
        $templates = new PlatesEngine(dirname(__FILE__, 2) . '/templates');
        return $templates->render('Login', ['name' => 'Jonathan']);
    }
}
