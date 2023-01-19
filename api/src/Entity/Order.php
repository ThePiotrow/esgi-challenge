<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\EntityIdTrait;
use App\Enum\OrderPaymentType;
use App\Enum\OrderStatusType;
use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
#[ApiResource]
class Order
{
    use EntityIdTrait;

    #[ORM\Column(length: 255)]
    private ?OrderStatusType $status = null;

    #[ORM\Column(length: 255)]
    private ?OrderPaymentType $payment_type = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ticket $ticket = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_order = null;

    public function getStatus(): ?OrderStatusType
    {
        return $this->status;
    }

    public function setStatus(OrderStatusType $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPaymentType(): ?OrderPaymentType
    {
        return $this->payment_type;
    }

    public function setPaymentType(OrderPaymentType $payment_type): self
    {
        $this->payment_type = $payment_type;

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

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    public function setTicket(?Ticket $ticket): self
    {
        $this->ticket = $ticket;

        return $this;
    }

    public function getUserOrder(): ?User
    {
        return $this->user_order;
    }

    public function setUserOrder(?User $user_order): self
    {
        $this->user_order = $user_order;

        return $this;
    }
}
