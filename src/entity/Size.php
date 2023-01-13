<?php

namespace App\entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('sizes')]
class Size implements \JsonSerializable
{
    #[Id]
    #[Column, GeneratedValue]
    private int $id;

    #[Column]
    private int $size;

    /**
     * @param int $id
     * @param int $size
     */
    public function __construct(int $id, int $size)
    {
        $this->id = $id;
        $this->size = $size;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'size' => $this->size
        ];
    }
}