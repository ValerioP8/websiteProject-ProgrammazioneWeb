<?php
namespace App\Service;

use App\Entity\EUser;
use App\Entity\ECreator;
use App\Entity\EPost;
use App\Entity\EModerator;
use App\Entity\Eblacklist;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EUserRepository;

class EModeratorService extends AbstractBaseService{

    public function banAndDestroy(EUser $user):void{
        
        //Save ban data
        $banData = new Eblacklist($user->getEmail());
        $this->entityManager->persist($banData);

        //Destroy
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

}
