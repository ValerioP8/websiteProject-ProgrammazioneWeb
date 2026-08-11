<?php
namespace App\Service;

use App\Entity\EUser;
use App\Entity\ECreator;
use App\Entity\EPost;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EUserRepository;

class EUserService extends AbstractBaseService {
    protected EUserRepository $userRepository;

    //  Override
    public function __construct(EntityManagerInterface $entityManager, EUserRepository $userRepository) 
    {
        parent::__construct($entityManager, User::class);
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }

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

    //Utility
    public function getByUsername(string $username): ?EUser{
        return $this->entityManager->getRepository(EUser::class)->findOneBy(['username' => $username]);
    }

    public function getByEmail(string $email): ?EUser{
        return $this->entityManager->getRepository(EUser::class)->findOneBy(['email' => $email]);
    }

    public function isUsernameTaken(string $username): bool{
        return $this->getByUsername($username) !== null;
    }

    public function isEmailTaken(string $email): bool{
        return $this->getByEmail($email) !== null;
    }

    public function getByPhonenumber(string $phoneNumber): ?EUser{
        return $this->entityManager->getRepository(EUser::class)->findOneBy(['phoneNumber' => $phoneNumber]);
    }

    public function isPhonenumberTaken(string $phoneNumber): bool{
        return $this->getByPhonenumber($phoneNumber) !== null;
    }

    public function searchByUsername(string $searchQuery): array{
        $cleanQuery = trim($searchQuery);
        if (mb_strlen($cleanQuery) < 3) {
            return [];
        }
        return $this->userRepository->searchByUsername($cleanQuery);
    }

}