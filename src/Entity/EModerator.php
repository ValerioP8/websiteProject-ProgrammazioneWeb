<?php
namespace App\Entity;

use App\Repository\EModeratorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EModeratorRepository::class)]
#[ORM\Table(name: 'moderators')]
class EModerator{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    // OneToOne relation with EUser - COMPOSITION
    #[ORM\OneToOne(targetEntity: EUser::class, inversedBy: 'moderatorProfile')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?EUser $user = null;


    // Getters

    public function getId(): ?int{
        return $this->id;
    }

    public function getUser(): ?EUser{
        return $this->user;
    }

    // Setters 
    public function setUser(EUser $user): void{
        $this->user = $user;
    }
}