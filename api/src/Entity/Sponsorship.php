<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\EntityIdTrait;
use App\Repository\SponsorshipRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SponsorshipRepository::class)]
#[ORM\Table(name: '`sponsporship`')]
#[ApiResource]
class Sponsorship
{
    use EntityIdTrait;

    #[ORM\ManyToOne(inversedBy: 'sponsorships')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Sponsor = null;

    #[ORM\OneToOne(inversedBy: 'sponsorship', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $sponsored = null;

    #[ORM\Column]
    private ?bool $email_validation = null;

    #[ORM\Column]
    private ?bool $sponsor_validation = null;

    public function getSponsor(): ?User
    {
        return $this->Sponsor;
    }

    public function setSponsor(?User $Sponsor): self
    {
        $this->Sponsor = $Sponsor;

        return $this;
    }

    public function getSponsored(): ?User
    {
        return $this->sponsored;
    }

    public function setSponsored(User $sponsored): self
    {
        $this->sponsored = $sponsored;

        return $this;
    }

    public function isEmailValidation(): ?bool
    {
        return $this->email_validation;
    }

    public function setEmailValidation(bool $email_validation): self
    {
        $this->email_validation = $email_validation;

        return $this;
    }

    public function isSponsorValidation(): ?bool
    {
        return $this->sponsor_validation;
    }

    public function setSponsorValidation(bool $sponsor_validation): self
    {
        $this->sponsor_validation = $sponsor_validation;

        return $this;
    }
}
