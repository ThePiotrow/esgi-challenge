<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\EntityIdTrait;
use App\Repository\FightCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FightCategoryRepository::class)]
#[ORM\Table(name: '`fight_category`')]
#[ApiResource]
class FightCategory
{
    use EntityIdTrait;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Fighter::class, mappedBy: 'category')]
    private Collection $fighters;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Event::class)]
    private Collection $events;

    #[ORM\OneToMany(mappedBy: 'fight_category', targetEntity: WeightCategory::class)]
    private Collection $weightCategories;

    public function __construct()
    {
        $this->fighters = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->weightCategories = new ArrayCollection();
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

    /**
     * @return Collection<int, Fighter>
     */
    public function getFighters(): Collection
    {
        return $this->fighters;
    }

    public function addFighter(Fighter $fighter): self
    {
        if (!$this->fighters->contains($fighter)) {
            $this->fighters[] = $fighter;
            $fighter->addCategory($this);
        }

        return $this;
    }

    public function removeFighter(Fighter $fighter): self
    {
        if ($this->fighters->removeElement($fighter)) {
            $fighter->removeCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setCategory($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getCategory() === $this) {
                $event->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WeightCategory>
     */
    public function getWeightCategories(): Collection
    {
        return $this->weightCategories;
    }

    public function addWeightCategory(WeightCategory $weightCategory): self
    {
        if (!$this->weightCategories->contains($weightCategory)) {
            $this->weightCategories[] = $weightCategory;
            $weightCategory->setFightCategory($this);
        }

        return $this;
    }

    public function removeWeightCategory(WeightCategory $weightCategory): self
    {
        if ($this->weightCategories->removeElement($weightCategory)) {
            // set the owning side to null (unless already changed)
            if ($weightCategory->getFightCategory() === $this) {
                $weightCategory->setFightCategory(null);
            }
        }

        return $this;
    }
}
