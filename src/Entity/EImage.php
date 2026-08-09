<?php
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
    private $imgData;

    #[ORM\Column(type: "string")]
    private string $imgFormat;

    // Constructor
    /**
     * @param int $id
     * @param $imgData
     * @param string $imgFormat
     */
    public function __construct(int $id, $imgData, string $imgFormat){
        $this->id = $id;
        $this->imgData = $imgData;
        $this->imgFormat = $imgFormat;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getImgData(){
        return $this->imgData;
    }

    public function getImgFormat(): string {
        return $this->imgFormat;
    }

    // Setters
    public function setImgData($imgData): void {
        $this->imgData = $imgData;
    }

    public function setImgFormat(string $imgFormat): void {
        $this->imgFormat = $imgFormat;
    }

}