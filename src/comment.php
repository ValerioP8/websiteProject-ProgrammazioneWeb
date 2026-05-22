<?php
// src/comment.php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "comments")]
class EComment {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string")]
    private string $content;

    // Constructor
    public function __construct(int $id, string $content) {
        $this->id = $id;
        $this->content = $content;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getContent(): string {
        return $this->content;
    }

    // Setters
    public function setContent(string $content): void {
        $this->content = $content;
    }

}