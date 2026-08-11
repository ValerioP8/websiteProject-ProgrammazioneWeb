<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\ECreatorRepository;

#[ORM\Entity(repositoryClass: ECreatorRepository::class)]
class ECreator extends EUser {
    #[ORM\Column(type: 'string', nullable: true)]
    private string $region;

    #[ORM\Column(type: 'string', nullable: true)]
    private string $province;

    #[ORM\Column(type: 'string', nullable: true)]
    private string $city;       //Comune

    //RELATIONS
    //OneToMany relation with EPost (BIDIRECTIONAL).
    #[ORM\OneToMany(mappedBy: 'creator', targetEntity: EPost::class, cascade: ['persist'])]
    private Collection $posts;

    // Constructor
    /**
     * @param int $id "Put 0 for NEW users, the DB will generate it."
     * @param string $username
     * @param string $passwordHash
     * @param string $phoneNumber
     * @param string $email
     * @param string $region
     * @param string $province
     * @param string $city
     */
    public function __construct(int $id, string $username, string $passwordHash, string $phoneNumber, string $email, string $region, string $province, string $city) {parent::__construct($id, $username, $passwordHash, $phoneNumber, $email);
        $this->region = $region;
        $this->province = $province;
        $this->city = $city;
        $this->posts = new ArrayCollection();
    }

    // Getters
    public function getRegion(): string {
        return $this->region;
    }

    public function getProvince(): string {
        return $this->province;
    }

    public function getCity(): string {
        return $this->city;
    }

    // Setters
    public function setRegion(string $region): void {
        $this->region = $region;
    }

    public function setProvince(string $province): void {
        $this->province = $province;
    }

    public function setCity(string $city): void {
        $this->city = $city;
    }



}