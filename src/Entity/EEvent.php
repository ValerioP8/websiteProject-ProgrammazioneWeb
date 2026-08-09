<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class EEvent extends EPost {
    #[ORM\Column(type: "integer")]    
    private int $MAXSUBS;

    #[ORM\Column(type: "string")]
    private string $uploadDate;

    #[ORM\Column(type: "string")]
    private string $endDate;

    // Constructor
    // Expected date format: "dd/mm/yyyy"
    /**
     * @param int $id "Put 0 for NEW events, the DB will generate it."
     * @param string $postType
     * @param string $title
     * @param string $content
     * @param int $MAXSUBS
     * @param string $uploadDate
     * @param string $endDate
     */
    public function __construct(int $id, string $postType, string $title, string $content, int $MAXSUBS, string $uploadDate, string $endDate) {parent::__construct($id, $postType, $title, $content);
            $this->MAXSUBS = $MAXSUBS;
            $this->uploadDate = $uploadDate;
            $this->endDate = $endDate;
    }

    // Getters
    public function getMAXSUBS(): int {
        return $this->MAXSUBS;
    }

    public function getUploadDate(): string {
        return $this->uploadDate;
    }

    public function getEndDate(): string {
        return $this->endDate;
    }

    // Setters
    /*  MAXSUBS is supposed to be set only at the creation of the obj.
    public function setMAXSUBS(int $MAXSUBS): void {
        $this->MAXSUBS = $MAXSUBS;
    }
    */

    public function setUploadDate(string $uploadDate): void {
        $this->uploadDate = $uploadDate;
    }

    public function setEndDate(string $endDate): void {
        $this->endDate = $endDate;
    }

}