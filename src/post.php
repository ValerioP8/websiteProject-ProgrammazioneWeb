<?php
// src/post.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/*
Same considerations as post, about the inheritance.
*/

/*
About the relation with image class:
OneToOne.
cascade: persist and remove: automatically saves the Image with the associated Event.
Automatically removes the image if the associated event is deleted.
*/

#[ORM\Entity]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'dtype', type: 'string')]
#[ORM\DiscriminatorMap(['post' => EPost::class, 'event' => EEvent::class])]
class EPost {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string")]
    private string $postType;

    #[ORM\Column(type: "string")]
    private string $title;

    #[ORM\Column(type: "string")]    
    private string $content;

    //RELATIONS
    #[ORM\OneToOne(targetEntity: EImage::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'image_id', referencedColumnName: 'id', nullable: true)]
    private ?EImage $image = null;    

    // Constructor
    public function __construct(int $id, string $postType, string $title, string $content) {
        $this->id = $id;
        $this->postType = $postType;
        $this->title = $title;
        $this->content = $content;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getPostType(): string {
        return $this->postType;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getContent(): string {
        return $this->content;
    }

    // Setters
    public function setPostType(string $postType): void {
        $this->postType = $postType;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    } 

}