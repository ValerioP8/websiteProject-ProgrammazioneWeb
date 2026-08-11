<?php
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
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?EUser $user = null;

    // ManyToOne relation with EPost (BIDIRECTIONAL).
    #[ORM\ManyToOne(targetEntity: EPost::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EPost $post = null;

    // Constructor
    /**
     * @param int $id "Put 0 for NEW comments, the DB will generate it."
     * @param string $content
     * @param EUser $user
     * @param EPost $post
     */
    public function __construct(int $id, string $content, EUser $user, EPost $post) {
        $this->id = $id;
        $this->content = $content;
        $this->user = $user;
        $this->post = $post;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function getPost(): ?EPost {
        return $this->post;
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