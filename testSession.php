<?php
ob_start(); //Buffer to avoid script errors - PHP doesn't like header changes after printing.
// Init mock for terminal
$_SERVER['HTTP_USER_AGENT'] = 'Floris';

require_once 'bootstrap.php';

use App\Service\SessionManager;
$session = new SessionManager();

// Check if Guest
echo ($session->isGuest() ? "GUEST" : "No") . "\n";

// Test Login
$session->login(2);
echo ($session->isLoggedIn() && $session->getUserId() === 2 ? "Logged in" : "No") . "\n";

// Hijacking
$_SERVER['HTTP_USER_AGENT'] = 'Not Floris';
$session = new SessionManager(); 
echo ($session->isGuest() ? "Logout cuz of unmatch" : "No") . "\n";