<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
require_once "vendor/autoload.php";

// the connection configuration
$dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'websiteDB',
];

//Fetch entity from:
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/src'],
    isDevMode: true,
);

// on PHP < 8.4, use ORMSetup::createAttributeMetadataConfiguration() instead
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);