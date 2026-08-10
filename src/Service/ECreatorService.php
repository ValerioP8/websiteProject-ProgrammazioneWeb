<?php
namespace App\Service;

use App\Entity\ECreator;
use Doctrine\ORM\EntityManagerInterface;

class ECreatorService extends AbstractBaseService {

    //Verify
    public function verifyPassword(ECreator $creator, string $password): bool{
        return password_verify($password, $creator->getPasswordHash());
    }
}