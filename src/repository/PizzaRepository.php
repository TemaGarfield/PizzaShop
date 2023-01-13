<?php

namespace App\repository;

use App\entity\Pizza;
use Doctrine\ORM\EntityManager;

class PizzaRepository implements Repository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAll(): array
    {
        return $this->entityManager->getRepository(Pizza::class)->findAll();
    }

    public function getById(int $id): Pizza|null
    {
        return $this->entityManager->getRepository(Pizza::class)->find($id);
    }
}