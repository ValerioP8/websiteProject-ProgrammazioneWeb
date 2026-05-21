<?php
// src/report.php
class EReport {
    private int $id;
    private string $reportType;
    private string $content;

    // Constructor
    public function __construct(int $id, string $reportType, string $content) {
        $this->id = $id;
        $this->reportType = $reportType;
        $this->content = $content;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getReportType(): string {
        return $this->reportType;
    }

    public function getContent(): string {
        return $this->content;
    }

    // Setters
    public function setReportType(string $reportType): void {
        $this->reportType = $reportType;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

}