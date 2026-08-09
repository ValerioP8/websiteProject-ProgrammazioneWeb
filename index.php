<?php
//EntityManager and Services startup - $entityManager
require_once "bootstrap.php";
use App\Service\ECommentService;
use App\Service\ECreatorService;
use App\Service\EEventService;
use App\Service\EImageService;
use App\Service\EPostService;
use App\Service\EUserService;
use App\Service\ReportHandlingService;

//Entities
use App\Entity\EComment;
use App\Entity\ECommentReport;
use App\Entity\ECreator;
use App\Entity\EEvent;
use App\Entity\EImage;
use App\Entity\EPost;
use App\Entity\EPostReport;
use App\Entity\EUser;
use App\Entity\EUserReport;

//Services startup (EntityManager injection)
$ECommentService = new ECommentService($entityManager);
$ECreatorService = new ECreatorService($entityManager);
$EEventService = new EEventService($entityManager);
$EImageService = new EImageService($entityManager);
$EPostService = new EPostService($entityManager);
$EUserService = new EUserService($entityManager);
$ReportHandlingService = new ReportHandlingService($entityManager);



