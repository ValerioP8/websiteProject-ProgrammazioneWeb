<?php
//EntityManager and Services startup - $entityManager
require_once "bootstrap.php";
use App\Service\EPostService;
use App\Service\EUserService;

//Entities
use App\Entity\EUser;

//Services startup (EntityManager injection)
$EPostService = new EPostService($entityManager);
$EUserService = new EUserService($entityManager);

//Test
$EUserService->generateTestUser();