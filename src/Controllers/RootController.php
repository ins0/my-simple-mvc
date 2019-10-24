<?php

namespace App\Controllers;

use App\Models\FooBarBaz;
use App\ViewRenderer\ViewRenderer;

class RootController extends Controller
{
    public function get()
    {
        echo ViewRenderer::renderTemplate('root', [
            'page_title' => 'hello world example',
            'title' => 'hello world',
            'array' => FooBarBaz::get(),
        ], "default");
    }
}
