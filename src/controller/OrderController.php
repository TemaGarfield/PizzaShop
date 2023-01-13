<?php

namespace App\controller;

use App\repository\OrderRepository;
use Doctrine\DBAL\Exception;

class OrderController
{
    private OrderRepository $orderRepository;
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function order(): void
    {
        try {
            $this->validate();

            $price = $this->orderRepository->getPrice($_POST['pizza_id'], $_POST['size_id']);

            echo json_encode($this->orderRepository->save($_POST['pizza_id'], $_POST['size_id'], $_POST['sauce_id'], $price));
        } catch (Exception $exception) {
            echo json_encode(array(
                'error' => array(
                    'message' => $exception->getMessage(),
                    'code' => $exception->getCode(),
                )
            ));
        }
    }

    /**
     * @throws Exception
     */
    private function validate(): void
    {
        if ($_POST['pizza_id'] == -1 || empty($_POST['pizza_id'])) {
            throw new Exception('Pizza not selected', 666);
        }

        if ($_POST['size_id'] == -1 || empty($_POST['size_id'])) {
            throw new Exception('Size not selected', 13);
        }
    }
}