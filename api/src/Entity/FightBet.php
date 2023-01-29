<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\EntityIdTrait;
use App\Repository\FightBetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FightBetRepository::class)]
#[ORM\Table(name: '`fight_bet`')]
#[ApiResource]
class FightBet
{
    use EntityIdTrait;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\ManyToOne(inversedBy: 'fightBets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fight $fight = null;

    #[ORM\OneToOne(inversedBy: 'fightBet', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fighter $bet_on = null;

    #[ORM\ManyToOne(inversedBy: 'fightBets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $bet_user = null;

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getFight(): ?Fight
    {
        return $this->fight;
    }

    public function setFight(?Fight $fight): self
    {
        $this->fight = $fight;

        return $this;
    }

    public function getBetOn(): ?Fighter
    {
        return $this->bet_on;
    }

    public function setBetOn(Fighter $bet_on): self
    {
        $this->bet_on = $bet_on;

        return $this;
    }

    public function getBetUser(): ?User
    {
        return $this->bet_user;
    }

    public function setBetUser(?User $bet_user): self
    {
        $this->bet_user = $bet_user;

        return $this;
    }
}
