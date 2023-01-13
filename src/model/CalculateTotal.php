<?php

namespace App\model;

use App\entity\Order;

class CalculateTotal
{
    public function calculate(Order $order, float $pizzaPrice): float
    {
        if ($order->getSauce() != null) {
            return $order->getSauce()->getPrice() + $pizzaPrice;
        }

        return $pizzaPrice;
    }
}