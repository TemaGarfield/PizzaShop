<?php

namespace App\controller;

class MainController
{
    public function index():void
    {
        header("Location: /pizza-shop/src/view/index.html");
    }
}