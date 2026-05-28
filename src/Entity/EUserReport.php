<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class EUserReport extends EAbstractReport {
    // Target User
    #[ORM\ManyToOne(targetEntity: EUser::class)]
    #[ORM\JoinColumn(name: 'reported_user_id', referencedColumnName: 'id', nullable: false)]
    private EUser $reportedUser;

    // Constructor
    public function __construct(int $id, string $reportSubtype, string $content, EUser $reportedUser) {
        parent::__construct($id, $reportSubtype, $content);
        $this->reportedUser = $reportedUser;
    }





}