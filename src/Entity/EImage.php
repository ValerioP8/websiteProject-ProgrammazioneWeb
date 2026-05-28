<?php
// src/Image.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "images")]

class EImage {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "blob")]
    private blob $imgData;

    #[ORM\Column(type: "string")]
    private string $imgFormat;

    // Constructor
    public function __construct(int $id, blob $imgData, string $imgFormat){
        $this->id = $id;
        $this->imgData = $imgData;
        $this->imgFormat = $imgFormat;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getImgData(): blob {
        return $this->imgData;
    }

    public function getImgFormat(): string {
        return $this->imgFormat;
    }

    // Setters
    public function setImgData(blob $imgData): void {
        $this->imgData = $imgData;
    }

    public function setImgFormat(string $imgFormat): void {
        $this->imgFormat = $imgFormat;
    }

}