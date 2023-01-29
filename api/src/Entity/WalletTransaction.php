<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\EntityIdTrait;
use App\Enum\WalletTransactionStatusType;
use App\Repository\WalletTransactionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WalletTransactionRepository::class)]
#[ORM\Table(name: '`wallet_transaction`')]
#[ApiResource]
class WalletTransaction
{
    use EntityIdTrait;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\ManyToOne(inversedBy: 'walletTransactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Wallet $wallet = null;

    #[ORM\Column(length: 255, enumType: WalletTransactionStatusType::class)]
    private ?WalletTransactionStatusType $status = null;

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getWallet(): ?Wallet
    {
        return $this->wallet;
    }

    public function setWallet(?Wallet $wallet): self
    {
        $this->wallet = $wallet;

        return $this;
    }

    public function getStatus(): ?WalletTransactionStatusType
    {
        return $this->status;
    }

    public function setStatus(WalletTransactionStatusType $status): self
    {
        $this->status = $status;

        return $this;
    }
}
