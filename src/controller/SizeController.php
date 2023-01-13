<?php

namespace App\controller;

use App\repository\SizeRepository;

class SizeController
{
    private SizeRepository $sizeRepository;

    public function __construct(SizeRepository $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
    }

    public function getAllSizes(): void
    {
        echo json_encode($this->sizeRepository->getAll());
    }
}