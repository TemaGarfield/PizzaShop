<?php

namespace App\repository;

use App\entity\Size;
use Doctrine\ORM\EntityManager;

class SizeRepository implements Repository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAll(): array
    {
        return $this->entityManager->getRepository(Size::class)->findAll();
    }

    public function getById(int $id): Size|null
    {
        return $this->entityManager->getRepository(Size::class)->find($id);
    }
}