<?php
// src/comment.php

class EComment {
    private int $id;
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