<?php
// src/user.php

use Doctrine\ORM\Mapping as ORM;

/*
Important: By choosing "SINGLE_TABLE", Doctrine will
manage the inheritance by storing all the attributes
in the same table.

A discriminator column is expected to save what kind
of user is stored in the table.
*/


#[ORM\Entity]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'dtype', type: 'string')]
#[ORM\DiscriminatorMap(['user' => EUser::class, 'creator' => ECreator::class])]
class EUser {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string")]
    private string $username;
    
    #[ORM\Column(type: "string")]
    private string $passwordHash;

    #[ORM\Column(type: "string")]
    private string $phoneNumber;

    #[ORM\Column(type: "string")]
    private string $accountType;

    #[ORM\Column(type: "string")]
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