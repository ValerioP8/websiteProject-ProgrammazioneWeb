<?php

declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

// Configurazione connessione DB
$connectionParams = [
    'dbname'   => 'websiteDB',
    'user'     => 'root',
    'password' => '',
    'host'     => '127.0.0.1',  //localhost
    'port'     => 3306,         //utilizzando la porta default
    'driver'   => 'pdo_mysql',
];

try {
    // Crea connessione Doctrine DBAL
    $conn = DriverManager::getConnection($connectionParams);

    // Verifica connessione
    $conn->connect();

    if ($conn->isConnected()) {
        echo "Database raggiungibile.\n";
        //Scrivi 1 se funziona tutto correttamente (lato DB)
        $result = $conn->executeQuery('SELECT 1');
        echo $result->fetchOne();
        echo "\n";
        //phpinfo();
    } else {
        echo "Impossibile connettersi al database.\n";
    }

} catch (Exception $e) {
    echo "Errore di connessione al database:\n";
    echo $e->getMessage() . "\n";
}