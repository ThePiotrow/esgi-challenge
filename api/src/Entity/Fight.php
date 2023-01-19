<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\EntityIdTrait;
use App\Repository\FightRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FightRepository::class)]
#[ORM\Table(name: '`fight`')]
#[ApiResource]
class Fight
{
    use EntityIdTrait;

    #[ORM\ManyToOne(inversedBy: 'fights')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Event $event = null;

    #[ORM\ManyToOne(inversedBy: 'fightersA')]
    private ?Fighter $fighterA = null;

    #[ORM\ManyToOne(inversedBy: 'fightersB')]
    private ?Fighter $fighterB = null;

    #[ORM\ManyToOne(inversedBy: 'winners')]
    private ?Fighter $winner = null;

    #[ORM\ManyToOne(inversedBy: 'losers')]
    private ?Fighter $loser = null;

    #[ORM\OneToMany(mappedBy: 'fight', targetEntity: FightBet::class)]
    private Collection $fightBets;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $winner_validation = null;

    public function __construct()
    {
        $this->fightBets = new ArrayCollection();
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getFighterA(): ?Fighter
    {
        return $this->fighterA;
    }

    public function setFighterA(?Fighter $fighterA): self
    {
        $this->fighterA = $fighterA;

        return $this;
    }

    public function getFighterB(): ?Fighter
    {
        return $this->fighterB;
    }

    public function setFighterB(?Fighter $fighterB): self
    {
        $this->fighterB = $fighterB;

        return $this;
    }

    public function getWinner(): ?Fighter
    {
        return $this->winner;
    }

    public function setWinner(?Fighter $winner): self
    {
        $this->winner = $winner;

        return $this;
    }

    public function getLoser(): ?Fighter
    {
        return $this->loser;
    }

    public function setLoser(?Fighter $loser): self
    {
        $this->loser = $loser;

        return $this;
    }

    /**
     * @return Collection<int, FightBet>
     */
    public function getFightBets(): Collection
    {
        return $this->fightBets;
    }

    public function addFightBet(FightBet $fightBet): self
    {
        if (!$this->fightBets->contains($fightBet)) {
            $this->fightBets[] = $fightBet;
            $fightBet->setFight($this);
        }

        return $this;
    }

    public function removeFightBet(FightBet $fightBet): self
    {
        if ($this->fightBets->removeElement($fightBet)) {
            // set the owning side to null (unless already changed)
            if ($fightBet->getFight() === $this) {
                $fightBet->setFight(null);
            }
        }

        return $this;
    }

    public function isWinnerValidation(): ?bool
    {
        return $this->winner_validation;
    }

    public function setWinnerValidation(bool $winner_validation): self
    {
        $this->winner_validation = $winner_validation;

        return $this;
    }
}
