<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
// src/userReport.php
use App\Entity\EAbstractReport;

#[ORM\Entity]
class EUserReport extends EAbstractReport {
    // Target User
    #[ORM\ManyToOne(targetEntity: EUser::class)]
    #[ORM\JoinColumn(name: 'reported_user_id', referencedColumnName: 'id', nullable: false)]
    private EUser $reportedUser;
}