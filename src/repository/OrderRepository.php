<?php

namespace App\repository;

use App\entity\Order;
use App\model\CalculateTotal;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;

class OrderRepository
{
    private EntityManager $entityManager;
    private PizzaRepository $pizzaRepository;
    private SizeRepository $sizeRepository;
    private SauceRepository $sauceRepository;

    private QueryBuilder $queryBuilder;

    private CalculateTotal $calculateTotal;

    public function __construct(
        EntityManager $entityManager,
        PizzaRepository $pizzaRepository,
        SizeRepository $sizeRepository,
        SauceRepository $sauceRepository,
        QueryBuilder $queryBuilder,
        CalculateTotal $calculateTotal
    )
    {
        $this->entityManager = $entityManager;
        $this->pizzaRepository = $pizzaRepository;
        $this->sizeRepository = $sizeRepository;
        $this->sauceRepository = $sauceRepository;
        $this->queryBuilder = $queryBuilder;
        $this->calculateTotal = $calculateTotal;
    }

    public function save(int $pizzaId, int $sizeId, int $sauceId, float $totalPrice): Order|string {
        $order = new Order();

        $order->setPizza($this->pizzaRepository->getById($pizzaId));
        $order->setSize($this->sizeRepository->getById($sizeId));
        $order->setSauce($this->sauceRepository->getById($sauceId));

        $order->setTotalPrice($this->calculateTotal->calculate($order, $totalPrice));

        try {
            $this->entityManager->persist($order);
            $this->entityManager->flush();
        } catch (ORMException $e) {
            return $e->getMessage();
        }

        return $order;
    }

    /**
     * @throws Exception
     */
    public function getPrice(int $pizzaId, int $sizeId): float {
        return $this->queryBuilder
            ->select('price')
            ->from('pizza_size_price')
            ->where('pizza_id=?')
            ->andWhere('size_id=?')
            ->setParameter(0, $pizzaId)
            ->setParameter(1, $sizeId)
            ->fetchOne();
    }

    public function getLast(): Order {
        return $this->entityManager->getRepository(Order::class)->findOneBy([], ['id' => 'DESC']);
    }
}