<?php

namespace App\repository;

use App\entity\Sauce;
use Doctrine\ORM\EntityManager;

class SauceRepository implements Repository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAll(): array
    {
        return $this->entityManager->getRepository(Sauce::class)->findAll();
    }

    public function getById(int $id): Sauce|null
    {
        return $this->entityManager->getRepository(Sauce::class)->find($id);
    }
}