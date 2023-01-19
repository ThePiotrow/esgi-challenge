<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\EntityIdTrait;
use App\Repository\WeightCategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: WeightCategoryRepository::class)]
#[ORM\Table(name: '`weight_category`')]
#[ApiResource]
class WeightCategory
{
    use EntityIdTrait;

    #[ORM\Column]
    private ?float $min_weight = null;

    #[ORM\Column]
    private ?float $max_weight = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'weightCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FightCategory $fight_category = null;

    public function getMinWeight(): ?float
    {
        return $this->min_weight;
    }

    public function setMinWeight(float $min_weight): self
    {
        $this->min_weight = $min_weight;

        return $this;
    }

    public function getMaxWeight(): ?float
    {
        return $this->max_weight;
    }

    public function setMaxWeight(float $max_weight): self
    {
        $this->max_weight = $max_weight;

        return $this;
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

    public function getFightCategory(): ?FightCategory
    {
        return $this->fight_category;
    }

    public function setFightCategory(?FightCategory $fight_category): self
    {
        $this->fight_category = $fight_category;

        return $this;
    }
}
