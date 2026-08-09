<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class EPostReport extends EAbstractReport {
    // Target Post
    #[ORM\ManyToOne(targetEntity: EPost::class)]
    #[ORM\JoinColumn(name: 'reported_post_id', referencedColumnName: 'id', nullable: true)]
    private EPost $reportedPost;

    // Constructor
    /**
     * @param int $id
     * @param string $reportSubtype
     * @param string $content
     * @param EPost $reportedPost
     */
    public function __construct(int $id, string $reportSubtype, string $content, EUser $reporter, EPost $reportedPost) {
        parent::__construct($id, $reportSubtype, $content, $reporter);
        $this->reportedPost = $reportedPost;
    }



}