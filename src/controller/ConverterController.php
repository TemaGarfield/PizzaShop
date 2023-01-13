<?php

namespace App\controller;

use App\model\Converter;

class ConverterController
{
    private Converter $converter;

    public function __construct(Converter $converter)
    {
        $this->converter = $converter;
    }

    public function convert(): void
    {
        echo json_encode($this->converter->convert($_POST['money']));
    }
}