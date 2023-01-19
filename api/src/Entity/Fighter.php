<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\EntityIdTrait;
use App\Repository\FighterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FighterRepository::class)]
#[ORM\Table(name: '`fighter`')]
#[ApiResource]
class Fighter
{
    use EntityIdTrait;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column]
    private ?float $height = null;

    #[ORM\Column]
    private ?float $weight = null;

    #[ORM\Column(length: 255)]
    private ?string $nationality = null;

    #[ORM\ManyToMany(targetEntity: FightCategory::class, inversedBy: 'fighters')]
    private Collection $category;

    #[ORM\OneToMany(mappedBy: 'fighterA', targetEntity: Fight::class)]
    private Collection $fightersA;


    #[ORM\OneToMany(mappedBy: 'fighterB', targetEntity: Fight::class)]
    private Collection $fightersB;

    #[ORM\OneToMany(mappedBy: 'winner', targetEntity: Fight::class)]
    private Collection $winners;

    #[ORM\OneToMany(mappedBy: 'loser', targetEntity: Fight::class)]
    private Collection $losers;

    #[ORM\OneToOne(mappedBy: 'bet_on', cascade: ['persist', 'remove'])]
    private ?FightBet $fightBet = null;

    #[ORM\Column(length: 255)]
    private ?string $gender = null;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->fightersA = new ArrayCollection();
        $this->fightersB = new ArrayCollection();
        $this->winners = new ArrayCollection();
        $this->losers = new ArrayCollection();
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * @return Collection<int, FightCategory>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(FightCategory $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(FightCategory $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Fight>
     */
    public function getFightersA(): Collection
    {
        return $this->fightersA;
    }

    public function addFightersA(Fight $fightersA): self
    {
        if (!$this->fightersA->contains($fightersA)) {
            $this->fightersA[] = $fightersA;
            $fightersA->setFighterA($this);
        }

        return $this;
    }

    public function removeFightersA(Fight $fightersA): self
    {
        if ($this->fightersA->removeElement($fightersA)) {
            // set the owning side to null (unless already changed)
            if ($fightersA->getFighterA() === $this) {
                $fightersA->setFighterA(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Fight>
     */
    public function getFightersB(): Collection
    {
        return $this->fightersB;
    }

    public function addFightersB(Fight $fightersB): self
    {
        if (!$this->fightersA->contains($fightersB)) {
            $this->fightersA[] = $fightersB;
            $fightersB->setFighterB($this);
        }

        return $this;
    }

    public function removeFightersB(Fight $fightersB): self
    {
        if ($this->fightersB->removeElement($fightersB)) {
            // set the owning side to null (unless already changed)
            if ($fightersB->getFighterB() === $this) {
                $fightersB->setFighterB(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Fight>
     */
    public function getFights(): Collection
    {
        return new ArrayCollection(
            array_merge($this->fightersA->toArray(), $this->fightersB->toArray())
        );
    }

    /**
     * @return Collection<int, Fight>
     */
    public function getWinners(): Collection
    {
        return $this->winners;
    }

    public function addWinner(Fight $winner): self
    {
        if (!$this->winners->contains($winner)) {
            $this->winners[] = $winner;
            $winner->setWinner($this);
        }

        return $this;
    }

    public function removeWinner(Fight $winner): self
    {
        if ($this->winners->removeElement($winner)) {
            // set the owning side to null (unless already changed)
            if ($winner->getWinner() === $this) {
                $winner->setWinner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Fight>
     */
    public function getLosers(): Collection
    {
        return $this->losers;
    }

    public function addLoser(Fight $loser): self
    {
        if (!$this->losers->contains($loser)) {
            $this->losers[] = $loser;
            $loser->setLoser($this);
        }

        return $this;
    }

    public function removeLoser(Fight $loser): self
    {
        if ($this->losers->removeElement($loser)) {
            // set the owning side to null (unless already changed)
            if ($loser->getLoser() === $this) {
                $loser->setLoser(null);
            }
        }

        return $this;
    }

    public function getFightBet(): ?FightBet
    {
        return $this->fightBet;
    }

    public function setFightBet(FightBet $fightBet): self
    {
        // set the owning side of the relation if necessary
        if ($fightBet->getBetOn() !== $this) {
            $fightBet->setBetOn($this);
        }

        $this->fightBet = $fightBet;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }
}
