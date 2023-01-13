<?php

namespace App\repository;

interface Repository {
    public function getAll(): array;
    public function getById(int $id): object|null;
}
