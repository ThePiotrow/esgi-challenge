<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\EntityIdTrait;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ORM\Table(name: '`event`')]
#[ApiResource]
class Event
{
    use EntityIdTrait;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $location = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $location_link = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $start_timestamp = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $end_timestamp = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(nullable: true)]
    private ?int $capacity = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FightCategory $category = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Fight::class)]
    private Collection $fights;

    public function __construct()
    {
        $this->fights = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getLocationLink(): ?string
    {
        return $this->location_link;
    }

    public function setLocationLink(?string $location_link): self
    {
        $this->location_link = $location_link;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(?int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getCategory(): ?FightCategory
    {
        return $this->category;
    }

    public function setCategory(?FightCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Fight>
     */
    public function getFights(): Collection
    {
        return $this->fights;
    }

    public function addFight(Fight $fight): self
    {
        if (!$this->fights->contains($fight)) {
            $this->fights[] = $fight;
            $fight->setEvent($this);
        }

        return $this;
    }

    public function removeFight(Fight $fight): self
    {
        if ($this->fights->removeElement($fight)) {
            // set the owning side to null (unless already changed)
            if ($fight->getEvent() === $this) {
                $fight->setEvent(null);
            }
        }

        return $this;
    }
}
