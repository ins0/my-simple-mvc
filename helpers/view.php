<?php

function view(string $pathToView, array $model = []): string
{
    extract($model);
    ob_start();
    require __DIR__ . '/../resources/views/' . $pathToView . '.php';
    return ob_get_clean();
}
