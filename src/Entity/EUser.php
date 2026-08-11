<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\EUserRepository;

/*
Important: By choosing "SINGLE_TABLE", Doctrine will
manage the inheritance by storing all the attributes
in the same table.

A discriminator column is expected to save what kind
of user is stored in the table.
*/

#[ORM\Entity(repositoryClass: EUserRepository::class)]
#[ORM\Table(name: "users")]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'dtype', type: 'string')]
#[ORM\DiscriminatorMap(['user' => EUser::class, 'creator' => ECreator::class])]
class EUser {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", unique: true)] //Note: Unique constraint for username, automatically adds an index for it.
    private string $username;
    
    #[ORM\Column(type: "string")]
    private string $passwordHash;

    #[ORM\Column(type: "string", unique: true, nullable: true)] // Unique and not necessary.
    private string $phoneNumber;

    #[ORM\Column(type: "string", unique: true)] //Note: Unique constraint for email, same as username.
    private string $email;
    
    //RELATIONS
    //OneToOne relation with EImage.
    #[ORM\OneToOne(targetEntity: EImage::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'image_id', referencedColumnName: 'id', nullable: true)]
    private ?EImage $image = null;   

    //OneToMany relation with EComment (BIDIRECTIONAL).
    #[ORM\OneToMany(targetEntity: EComment::class, mappedBy: 'user', cascade: ['remove'])]
    private Collection $comments;

    //ManyToMany relation with EPost (BIDIRECTIONAL) [Liking persistence].
    #[ORM\ManyToMany(targetEntity: EPost::class, inversedBy: 'likedByUsers')]
    #[ORM\JoinTable(name: 'users_likes_posts')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'post_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Collection $likedPosts;

    //ManyToMany Asymmetric self-reference relation.
    //Followings side.
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'followers')]
    #[ORM\JoinTable(name: 'user_follows')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'following_user_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Collection $following;
    //Followers side.
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'following')]
    private Collection $followers;
    /*
    Note: user_id is the Follower, following_user_id is is the followed (by user_id).
    */

    //Moderator relation by COMPOSITION--------------
    #[ORM\OneToOne(targetEntity: EModerator::class, mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?EModerator $moderatorProfile = null;

    public function getModeratorProfile(): ?EModerator{
    return $this->moderatorProfile;
    }

    public function setModeratorProfile(?EModerator $moderatorProfile): void{
    $this->moderatorProfile = $moderatorProfile;
    
    // sync
    if ($moderatorProfile !== null && $moderatorProfile->getUser() !== $this) {
        $moderatorProfile->setUser($this);
    }
    }

    //-----------------



    // Constructor
    /**
     * @param int $id "Put 0 for NEW users, the DB will generate it."
     * @param string $username
     * @param string $passwordHash
     * @param string $phoneNumber
     * @param string $email
     */
    public function __construct(int $id, string $username, string $passwordHash, string $phoneNumber, string $email) {
        $this->id = $id;
        $this->username = $username;
        $this->passwordHash = $passwordHash;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->comments = new ArrayCollection();
        $this->likedPosts = new ArrayCollection();
        $this->following = new ArrayCollection();
        $this->followers = new ArrayCollection();
        $this->image = null;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPasswordHash(): string {
        return $this->passwordHash;
    }

    public function getPhoneNumber(): string {
        return $this->phoneNumber;
    }

    public function getAccountType(): string {
        return $this->accountType;
    }

    public function getEmail(): string {
        return $this->email;
    }

    // Setters
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setPasswordHash(string $passwordHash): void {
        $this->passwordHash = $passwordHash;
    }

    public function setPhoneNumber(string $phoneNumber): void {
        $this->phoneNumber = $phoneNumber;
    }

    public function setAccountType(string $accountType): void {
        $this->accountType = $accountType;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    /**
     * @return Collection<int, EComment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    // Liking functions -----------
    // Add like if not liked
    public function addLikeTo(EPost $post): void{
        if (!$this->likedPosts->contains($post)) {
            $this->likedPosts->add($post);
        }
    }

    // Remove like
    public function removeLikeFrom(EPost $post): void{
        $this->likedPosts->removeElement($post);
    }

    // Check if liked
    public function isLiked(EPost $post): bool{
        return $this->likedPosts->contains($post);
    }

    //Following functions -----------
    // Follow a user
    public function follow(ECreator $creator): void{
        if (!$this->following->contains($creator)) {
            $this->following->add($creator);
        }
    }

    // Unfollow a user
    public function unfollow(ECreator $creator): void{
        $this->following->removeElement($creator);
    }

}