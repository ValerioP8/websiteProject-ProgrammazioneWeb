<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
#[ORM\Table(name: "posts")]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'dtype', type: 'string')]
#[ORM\DiscriminatorMap(['post' => EPost::class, 'event' => EEvent::class])]
#[ORM\Index(name: 'idx_posts_search', columns: ['title', 'content'], flags: ['fulltext'])] //Add Fulltext Index for title and content search
class EPost {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string")]
    private string $title;

    #[ORM\Column(type: "string")]    
    private string $content;

    //RELATIONS
    // OneToOne relation with EImage.
    #[ORM\OneToOne(targetEntity: EImage::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'image_id', referencedColumnName: 'id', nullable: true)]
    private ?EImage $image = null;
    
    //OneToMany relation with EComment (BIDIRECTIONAL).
    #[ORM\OneToMany(mappedBy: 'post', targetEntity: EComment::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $comments;

    //ManyToOne relation with ECreator (BIDIRECTIONAL).
    #[ORM\ManyToOne(targetEntity: ECreator::class, inversedBy: 'posts')]
    #[ORM\JoinColumn(name: 'creator_id', referencedColumnName: 'id', nullable: false)]
    private ?ECreator $creator = null;

    //ManyToMany relation with EUser (BIDIRECTIONAL) [Liking persistence].
    #[ORM\ManyToMany(targetEntity: EUser::class, mappedBy: 'likedPosts')]
    private Collection $likedByUsers;

    // Constructor
    /**
     * @param int $id
     * @param string $title
     * @param string $content
     * @param EImage|null $image
     * @param ECreator $creator
     */
    public function __construct(int $id, string $title, string $content, EImage $image = null, ECreator $creator) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->image = $image;
        $this->creator = $creator;
        $this->comments = new ArrayCollection();
        $this->likedByUsers = new ArrayCollection();
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

    /**
     * @return Collection<int, EComment>
     */
    public function getComments(): Collection {
        return $this->comments;
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