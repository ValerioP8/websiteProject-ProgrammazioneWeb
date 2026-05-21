<?php
// src/user.php
class EUser {
    private int $id;
    private string $username;
    private string $passwordHash;
    private string $phoneNumber;
    private string $accountType;
    private string $email;

    // Constructor
    public function __construct(int $id, string $username, string $passwordHash, string $phoneNumber, string $accountType, string $email) {
        $this->id = $id;
        $this->username = $username;
        $this->passwordHash = $passwordHash;
        $this->phoneNumber = $phoneNumber;
        $this->accountType = $accountType;
        $this->email = $email;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPasswordHash(): string {
        return $this->passwordHash;
    }

    public function getPhoneNumber(): string {
        return $this->phoneNumber;
    }

    public function getAccountType(): string {
        return $this->accountType;
    }

    public function getEmail(): string {
        return $this->email;
    }

    // Setters
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setPasswordHash(string $passwordHash): void {
        $this->passwordHash = $passwordHash;
    }

    public function setPhoneNumber(string $phoneNumber): void {
        $this->phoneNumber = $phoneNumber;
    }

    public function setAccountType(string $accountType): void {
        $this->accountType = $accountType;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }


}