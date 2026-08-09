<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class ECommentReport extends EAbstractReport {
    // Target Comment
    #[ORM\ManyToOne(targetEntity: EComment::class)]
    #[ORM\JoinColumn(name: 'reported_comment_id', referencedColumnName: 'id', nullable: true)]
    private EComment $reportedComment;

    // Constructor
    /**
     * @param int $id
     * @param string $reportSubtype
     * @param string $content
     * @param EUser $reporter
     * @param EComment $reportedComment
     */
    public function __construct(int $id, string $reportSubtype, string $content, EUser $reporter, EComment $reportedComment) {
        parent::__construct($id, $reportSubtype, $content, $reporter);
        $this->reportedComment = $reportedComment;
    }

}