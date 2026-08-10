<?php
namespace App\Service;

use App\Entity\EAbstractReport;
use App\Entity\EPostReport;
use App\Entity\EUserReport;
use App\Entity\ECommentReport;
use App\Entity\EPost;
use App\Entity\EUser;
use App\Entity\EComment;
use Doctrine\ORM\EntityManagerInterface;

class ReportHandlingService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    //Report creation methods
    //User
    public function persistUserReport(EUserReport $userReport): EUserReport{
        $this->entityManager->persist($userReport);
        $this->entityManager->flush();
        return $userReport;
    }

    //Post
    public function persistPostReport(EPostReport $postReport): EPostReport{
        $this->entityManager->persist($postReport);
        $this->entityManager->flush();
        return $postReport;
    }

    //Comment
    public function persistCommentReport(ECommentReport $commentReport): ECommentReport{
        $this->entityManager->persist($commentReport);
        $this->entityManager->flush();
        return $commentReport;
    }
    
}