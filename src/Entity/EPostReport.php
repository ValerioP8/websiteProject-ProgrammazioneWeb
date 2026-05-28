<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class EPostReport extends EAbstractReport {
    // Target Post
    #[ORM\ManyToOne(targetEntity: EPost::class)]
    #[ORM\JoinColumn(name: 'reported_post_id', referencedColumnName: 'id', nullable: false)]
    private EPost $reportedPost;

    // Constructor
    public function __construct(int $id, string $reportSubtype, string $content, EPost $reportedPost) {
        parent::__construct($id, $reportSubtype, $content);
        $this->reportedPost = $reportedPost;
    }



}