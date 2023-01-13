<?php

namespace App\entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('orders')]
class Order implements \JsonSerializable
{
    #[Id]
    #[Column, GeneratedValue]
    private int $id;

    #[OneToOne(targetEntity: Pizza::class)]
    private Pizza $pizza;

    #[OneToOne(targetEntity: Size::class)]
    private Size $size;

    #[OneToOne(targetEntity: Sauce::class)]
    private Sauce|null $sauce = null;

    #[Column('total_price')]
    private float $totalPrice;

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
     * @return Pizza
     */
    public function getPizza(): Pizza
    {
        return $this->pizza;
    }

    /**
     * @param Pizza $pizza
     */
    public function setPizza(Pizza $pizza): void
    {
        $this->pizza = $pizza;
    }

    /**
     * @return Size
     */
    public function getSize(): Size
    {
        return $this->size;
    }

    /**
     * @param Size $size
     */
    public function setSize(Size $size): void
    {
        $this->size = $size;
    }

    /**
     * @return Sauce|null
     */
    public function getSauce(): Sauce|null
    {
        return $this->sauce;
    }

    /**
     * @param Sauce|null $sauce
     */
    public function setSauce(Sauce|null $sauce): void
    {
        $this->sauce = $sauce;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     */
    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }


    public function jsonSerialize(): array
    {
        return [
          'pizza' => $this->pizza,
          'size' => $this->size,
          'sauce' => $this->sauce,
          'totalPrice' => $this->totalPrice,
        ];
    }
}