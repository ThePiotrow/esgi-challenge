<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\ResetPasswordController;
use App\Controller\UserController;
use App\Entity\Traits\EntityIdTrait;
use App\Repository\UserRepository;
use App\State\UserPasswordHasher;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\PseudoTypes\PositiveInteger;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(processor: UserPasswordHasher::class),
        new Put(processor: UserPasswordHasher::class),
        new Patch(processor: UserPasswordHasher::class),
        new Delete(),
        new Get(
            name: 'me',
            uriTemplate: '/users/me',
            controller: UserController::class
        )
    ]
)]
#[Post]
#[Get]
#[GetCollection]
#[Patch]
#[Patch(
    uriTemplate: '/users/reset/password',
    controller: ResetPasswordController::class,
    name: 'reset-password'
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use EntityIdTrait;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[SerializedName('password')]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\OneToOne(mappedBy: 'user_wallet', cascade: ['persist', 'remove'])]
    private ?Wallet $wallet = null;

    #[ORM\OneToMany(mappedBy: 'bet_user', targetEntity: FightBet::class)]
    private Collection $fightBets;

    #[ORM\OneToMany(mappedBy: 'user_order', targetEntity: Order::class)]
    private Collection $orders;

    #[ORM\OneToMany(mappedBy: 'Sponsor', targetEntity: Sponsorship::class)]
    private Collection $sponsorships;

    #[ORM\OneToOne(mappedBy: 'sponsored', cascade: ['persist', 'remove'])]
    private ?Sponsorship $sponsorship = null;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $email_validated = false;

    public function __construct()
    {
        $this->fightBets = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->sponsorships = new ArrayCollection();
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getWallet(): ?Wallet
    {
        return $this->wallet;
    }

    public function setWallet(Wallet $wallet): self
    {
        // set the owning side of the relation if necessary
        if ($wallet->getUserWallet() !== $this) {
            $wallet->setUserWallet($this);
        }

        $this->wallet = $wallet;

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
            $fightBet->setBetUser($this);
        }

        return $this;
    }

    public function removeFightBet(FightBet $fightBet): self
    {
        if ($this->fightBets->removeElement($fightBet)) {
            // set the owning side to null (unless already changed)
            if ($fightBet->getBetUser() === $this) {
                $fightBet->setBetUser(null);
            }
        }

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
            $order->setUserOrder($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getUserOrder() === $this) {
                $order->setUserOrder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sponsorship>
     */
    public function getSponsorships(): Collection
    {
        return $this->sponsorships;
    }

    public function addSponsorship(Sponsorship $sponsorship): self
    {
        if (!$this->sponsorships->contains($sponsorship)) {
            $this->sponsorships[] = $sponsorship;
            $sponsorship->setSponsor($this);
        }

        return $this;
    }

    public function removeSponsorship(Sponsorship $sponsorship): self
    {
        if ($this->sponsorships->removeElement($sponsorship)) {
            // set the owning side to null (unless already changed)
            if ($sponsorship->getSponsor() === $this) {
                $sponsorship->setSponsor(null);
            }
        }

        return $this;
    }

    public function getSponsorship(): ?Sponsorship
    {
        return $this->sponsorship;
    }

    public function setSponsorship(Sponsorship $sponsorship): self
    {
        // set the owning side of the relation if necessary
        if ($sponsorship->getSponsored() !== $this) {
            $sponsorship->setSponsored($this);
        }

        $this->sponsorship = $sponsorship;

        return $this;
    }

    public function isEmailValidated(): ?bool
    {
        return $this->email_validated;
    }

    public function setEmailValidated(bool $email_validated): self
    {
        $this->email_validated = $email_validated;

        return $this;
    }
}
