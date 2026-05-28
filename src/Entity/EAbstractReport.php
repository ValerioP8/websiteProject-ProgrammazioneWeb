<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
// src/abstractReport.php

//Abstract class: There will be 3 extentions {EUserReport, EPostReport, ECommentReport}
#[ORM\Entity]
#[ORM\Table(name: 'reports')]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap(['user'=> EUserReport::class, 'post'=> EPostReport::class, 'comment'=> ECommentReport::class])]
abstract class EAbstractReport {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $reportSubtype; // Example: racism, bad language, ecc.

    #[ORM\Column(type: 'string')]
    private string $content;

    //RELATIONS
    //ManyToOne relation with EUser (author of the report)
    #[ORM\ManyToOne(targetEntity: EUser::class)]
    #[ORM\JoinColumn(name: 'author_id', referencedColumnName: 'id', nullable: false)]
    private EUser $author;

    // Constructor
    public function __construct(int $id, string $reportSubtype, string $content) {
        $this->id = $id;
        $this->reportSubtype = $reportSubtype;
        $this->content = $content;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getReportSubtype(): string {
        return $this->reportSubtype;
    }

    public function getContent(): string {
        return $this->content;
    }

    // Setters
    public function setReportSubtype(string $reportSubtype): void {
        $this->reportSubtype = $reportSubtype;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

}
