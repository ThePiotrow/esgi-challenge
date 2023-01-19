<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait EntityIdTrait
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    private ?string $id = null;
    
    public function getId(): ?string
    {
        return $this->id;
    }
}
