<?php
// src/comment.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "comments")]
class EComment {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string")]
    private string $content;

    //RELATIONS
    // ManyToOne: many comments can be associated with one user. (BIDIRECTIONAL)
    #[ORM\ManyToOne(targetEntity: EUser::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private ?EUser $user = null;

    // ManyToOne relation with EPost (BIDIRECTIONAL).
    #[ORM\ManyToOne(targetEntity: EPost::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EPost $post = null;

    // Constructor
    public function __construct(int $id, string $content, EUser $user) {
        $this->id = $id;
        $this->content = $content;
        $this->user = $user;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function getUser(): ?EUser {
        return $this->user;
    }

    // Setters
    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function setUser(EUser $user): void {
        $this->user = $user;
    }

}