<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalCartPrice;

    /**
     * @ORM\Column(type="string", length=1024)
     */
    private $orderData;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPrdId(): ?int
    {
        return $this->prd_id;
    }

    public function setPrdId(int $prd_id): self
    {
        $this->prd_id = $prd_id;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTotalCartPrice(): ?int
    {
        return $this->totalCartPrice;
    }

    public function setTotalCartPrice(int $totalCartPrice): self
    {
        $this->totalCartPrice = $totalCartPrice;

        return $this;
    }

    public function getOrderData(): ?string
    {
        return $this->orderData;
    }

    public function setOrderData(string $orderData): self
    {
        $this->orderData = $orderData;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "id"=> $this->getId(),
            "user_id" => $this->getUserId(),
            "address"=> $this->getAddress(),
            "phone"=> $this->getPhone(),
            "status"=> $this->getStatus(),
            "total_cart_price"=> $this->getTotalCartPrice(),
            "order_data"=> $this->getOrderData()
        ];
    }
}
