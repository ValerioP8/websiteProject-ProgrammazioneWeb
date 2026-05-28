<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
// src/postReport.php
use App\Entity\EAbstractReport;
require_once 'abstractReport.php';
#[ORM\Entity]
class EPostReport extends EAbstractReport {
    // Target Post
    #[ORM\ManyToOne(targetEntity: EPost::class)]
    #[ORM\JoinColumn(name: 'reported_post_id', referencedColumnName: 'id', nullable: false)]
    private EPost $reportedPost;
}