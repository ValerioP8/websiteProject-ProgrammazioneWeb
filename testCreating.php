<?php
//EntityManager and Services startup - $entityManager
require_once "bootstrap.php";
use Doctrine\ORM\Tools\SchemaTool;

use App\Service\ECommentService;
use App\Service\ECreatorService;
use App\Service\EEventService;
use App\Service\EImageService;
use App\Service\EPostService;
use App\Service\EUserService;
use App\Service\ReportHandlingService;
use App\Service\AbstractBaseService;

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

//Repos
use App\Repository\EPostRepository;
$EPostRepository = $entityManager->getRepository(EPost::class);

//Services startup (EntityManager injection)
$ECommentService = new ECommentService($entityManager);
$ECreatorService = new ECreatorService($entityManager);
$EEventService = new EEventService($entityManager);
$EImageService = new EImageService($entityManager);
$EPostService = new EPostService($entityManager,$EPostRepository);
$EUserService = new EUserService($entityManager);
$ReportHandlingService = new ReportHandlingService($entityManager);

//TEST-------------------------

function resetDatabase($entityManager): void
{
    $schemaTool = new SchemaTool($entityManager);
    
    $metadata = $entityManager->getMetadataFactory()->getAllMetadata();
    $schemaTool->dropSchema($metadata);
    $schemaTool->createSchema($metadata);
}

//clean-up before starting
resetDatabase($entityManager);


//Inputs

$blob = fopen('php://memory', 'r+');
fwrite($blob, random_bytes(1024));   //Generate 1KB of random data in RAM
rewind($blob);

$blob1 = fopen('php://memory', 'r+');
fwrite($blob1, random_bytes(1024));   //Generate 1KB of random data in RAM
rewind($blob1);

$image = new EImage(0,$blob,"png");
$image1 = new EImage(0,$blob1,"jpg");
$user = new EUser(0,"TestName",password_hash("TestPasswordHash", PASSWORD_DEFAULT),"TestPhoneNumber1","TestEmail1");
$creator = new ECreator(0,"TestCreator","TestPasswordHash","TestPhoneNumber2","TestEmail2","Region","Province","City");
$post = new EPost(0,"JustTitle","JustDescription",$image,$creator);
$event = new EEvent(0,"TestTitle","TestDescription",$image1,$creator,20,"10/10/10","11/10/10");
$comment = new EComment(0,"TestComment",$user,$post);

$reportComment = new ECommentReport(0,"subtype","content",$user,$comment);
$reportUser = new EUserReport(0,"subtype","content",$user,$creator);
$reportPost = new EPostReport(0,"subtype","content",$creator,$post);

//DB interaction
$EImageService->persist($image);
$EUserService->persist($user);
$ECreatorService->persist($creator);
$EPostService->persist($post);
$EEventService->persist($event);
$ECommentService->persist($comment);
$ReportHandlingService->persistCommentReport($reportComment);
$ReportHandlingService->persistUserReport($reportUser);
$ReportHandlingService->persistPostReport($reportPost);

//Liking test
$EUserService->like($user,$post);

//Following test
$EUserService->follow($user,$creator);

//Read test
$readUser = $EUserService->getById(EUser::class,$user->getId());
if ($readUser !== null) {
    echo "ID: " . $readUser->getId() . "\n";
    echo "Username: " . $readUser->getUsername() . "\n";
    echo "Password Hash: " . $readUser->getPasswordHash() . "\n";
    echo "Verification: " . ($EUserService->verifyPassword($readUser, "TestPasswordHash") ? "Success" : "Failure") . "\n";
    echo "Email: " . $readUser->getEmail() . "\n";
}

//Search test
$searchResults = $EPostService->findAffinedPosts("Test");
if (!empty($searchResults)) {
    echo "Search Results:\n";
    foreach ($searchResults as $result) {
        echo "ID: " . $result->getId() . ", Title: " .$result->getTitle() . ", Content: " . $result->getContent() . "\n";
    }
} 
else {
    echo "No search results found.\n";
}   


