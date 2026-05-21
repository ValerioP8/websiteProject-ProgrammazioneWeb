<?php
// src/creator.php
require_once 'user.php';

class ECreator extends EUser {
    private string $region;
    private string $province;
    private string $city;       //Comune

    // Constructor
    public function __construct(string $name, string $surname, string $email, string $password, string $region, string $province, string $city) {parent::__construct($name, $surname, $email, $password);
        $this->region = $region;
        $this->province = $province;
        $this->city = $city;
    }

    // Getters
    public function getRegion(): string {
        return $this->region;
    }

    public function getProvince(): string {
        return $this->province;
    }

    public function getCity(): string {
        return $this->city;
    }

    // Setters
    public function setRegion(string $region): void {
        $this->region = $region;
    }

    public function setProvince(string $province): void {
        $this->province = $province;
    }

    public function setCity(string $city): void {
        $this->city = $city;
    }

}