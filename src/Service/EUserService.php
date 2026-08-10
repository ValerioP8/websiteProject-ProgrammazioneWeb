<?php
namespace App\Service;

use App\Entity\EUser;
use App\Entity\ECreator;
use App\Entity\EPost;
use Doctrine\ORM\EntityManagerInterface;

class EUserService extends AbstractBaseService {

    // Liking
    public function like(EUser $user, EPost $post): void{
        $user->addLikeTo($post);
        $this->persist($user);
    }

    public function unlike(EUser $user, EPost $post): void{
        $user->removeLikeFrom($post);
        $this->persist($user);
    }

    public function toggleLike(EUser $user, EPost $post): bool{
        if ($user->isLiked($post)) {
            $this->unlike($user, $post);
            return false; // Rimosso
        }
        $this->like($user, $post);
        return true; // Aggiunto
    }

    //Following
    public function follow(EUser $user, ECreator $creator): void{
        $user->follow($creator);
        $this->persist($user);
    }

    public function unfollow(EUser $user, ECreator $creator): void{
        $user->unfollow($creator);
        $this->persist($user);
    }

    //Verify
    public function verifyPassword(EUser $user, string $password): bool{
        return password_verify($password, $user->getPasswordHash());
    }

}