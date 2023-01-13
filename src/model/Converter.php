<?php

namespace App\model;

use App\repository\OrderRepository;

class Converter
{
    private const PRECISION = 2;
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function convert(float $exchangeRate): float
    {
        return round($this->orderRepository->getLast()->getTotalPrice() * $exchangeRate, self::PRECISION);
    }
}