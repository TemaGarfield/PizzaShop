<?php

namespace App\controller;

use App\repository\PizzaRepository;

class PizzaController
{
    private PizzaRepository $pizzaRepository;

    public function __construct(PizzaRepository $pizzaRepository)
    {
        $this->pizzaRepository = $pizzaRepository;
    }

    public function getAll(): void
    {
        echo json_encode($this->pizzaRepository->getAll());
    }
}