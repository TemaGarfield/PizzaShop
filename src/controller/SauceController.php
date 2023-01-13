<?php

namespace App\controller;

use App\repository\SauceRepository;

class SauceController
{
    private SauceRepository $sauceRepository;

    public function __construct(SauceRepository $sauceRepository)
    {
        $this->sauceRepository = $sauceRepository;
    }

    public function getAll(): void
    {
        echo json_encode($this->sauceRepository->getAll());
    }
}