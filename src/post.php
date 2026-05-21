<?php
// src/post.php
class EPost {
    private int $id;
    private string $postType;
    private string $title;
    private string $content;

    // Constructor
    public function __construct(int $id, string $postType, string $title, string $content) {
        $this->id = $id;
        $this->postType = $postType;
        $this->title = $title;
        $this->content = $content;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getPostType(): string {
        return $this->postType;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getContent(): string {
        return $this->content;
    }

    // Setters
    public function setPostType(string $postType): void {
        $this->postType = $postType;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    } 

}