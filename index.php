<?php
//EntityManager and Services startup - $entityManager
require_once "bootstrap.php";
use App\Service\EPostService;
use App\Service\EUserService;
use App\Service\ECreatorService;

//Entities
use App\Entity\EUser;
use App\Entity\ECreator;
use App\Entity\EPost;

//Services startup (EntityManager injection)
$EPostService = new EPostService($entityManager);
$EUserService = new EUserService($entityManager);
$ECreatorService = new ECreatorService($entityManager);

//Test ---
/*
$EUserService->generateTestUser();
$ECreatorService->generateTestCreator();
$testCreator = $ECreatorService->getCreatorById(13);
$post = new EPost(0, "post", "Test Post", "This is a test post.", null, $testCreator);
$EPostService->createPost($post);
*/
