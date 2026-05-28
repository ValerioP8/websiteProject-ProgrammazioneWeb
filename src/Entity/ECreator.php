<?php
// src/creator.php
namespace App\Entity;
use App\Entity\EUser;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
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
    public function __construct(string $name, string $surname, string $email, string $password, string $region, string $province, string $city) {parent::__construct($name, $surname, $email, $password);
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