<?php

namespace App\Entity;

use App\Repository\OrderLineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderLineRepository::class)]
class OrderLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $product_id;

    #[ORM\ManyToOne(targetEntity: Orders::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $order_id;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\Column(type: 'float')]
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?product
    {
        return $this->product_id;
    }

    public function setProductId(?product $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getOrderId(): ?orders
    {
        return $this->order_id;
    }

    public function setOrderId(?orders $order_id): self
    {
        $this->order_id = $order_id;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
