<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "blacklist")]
class Eblacklist{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    private ?string $emailHash = null;

    public function __construct(string $emailHash){
        $this->emailHash = $emailHash;
    }

    public function getId(): ?int{
        return $this->id;
    }

    public function getEmailHash(): string{
        return $this->emailHash;
    }

}