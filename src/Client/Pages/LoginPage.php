<?php

declare(strict_types=1);

namespace MinhasHoras\Client\Pages;

use MinhasHoras\Http\TemplateEngineInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginPage extends Page
{
    protected function render(
        TemplateEngineInterface $templateEngine,
        ServerRequestInterface $request
    ): string {
        return $templateEngine->render('Login', ['name' => 'Jonathan']);
    }
}
