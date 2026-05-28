<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
// src/commentReport.php
use App\Entity\EAbstractReport;
require_once 'abstractReport.php';

#[ORM\Entity]
class ECommentReport extends EAbstractReport {
    // Target Comment
    #[ORM\ManyToOne(targetEntity: EComment::class)]
    #[ORM\JoinColumn(name: 'reported_comment_id', referencedColumnName: 'id', nullable: false)]
    private EComment $reportedComment;
}