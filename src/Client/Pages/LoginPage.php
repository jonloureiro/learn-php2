<?php

declare(strict_types=1);

namespace MinhasHoras\Client\Pages;

use MinhasHoras\Http\TemplateEngineInterface;

class LoginPage extends Page
{
    protected function render(TemplateEngineInterface $templateEngine): string
    {
        return $templateEngine->render('Login', ['name' => 'Jonathan']);
    }
}
