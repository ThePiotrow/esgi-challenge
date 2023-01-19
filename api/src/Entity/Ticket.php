<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\EntityIdTrait;
use App\Repository\TicketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
#[ORM\Table(name: '`ticket`')]
#[ApiResource]
class Ticket
{
    use EntityIdTrait;

    #[ORM\Column(length: 255)]
    private ?string $price = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TicketCategory $category = null;

    #[ORM\Column]
    private ?bool $availability = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $start_timestamp = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $end_timestamp = null;

    #[ORM\OneToMany(mappedBy: 'ticket', targetEntity: Order::class)]
    private Collection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?TicketCategory
    {
        return $this->category;
    }

    public function setCategory(?TicketCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function isAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    public function getStartTimestamp(): ?\DateTimeInterface
    {
        return $this->start_timestamp;
    }

    public function setStartTimestamp(\DateTimeInterface $start_timestamp): self
    {
        $this->start_timestamp = $start_timestamp;

        return $this;
    }

    public function getEndTimestamp(): ?\DateTimeInterface
    {
        return $this->end_timestamp;
    }

    public function setEndTimestamp(\DateTimeInterface $end_timestamp): self
    {
        $this->end_timestamp = $end_timestamp;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setTicket($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getTicket() === $this) {
                $order->setTicket(null);
            }
        }

        return $this;
    }
}
