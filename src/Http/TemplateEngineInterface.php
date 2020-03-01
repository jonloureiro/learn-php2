<?php

declare(strict_types=1);

namespace MinhasHoras\Http;

interface TemplateEngineInterface
{
    public function render($name, array $data = array());
}
