<?php
namespace App\Service;

/*
 *  About the SessionManager:
 *  role = USER : Logged in user (or creator, moderator, etc.)        |       role = GUEST : obvious
 *  user_ID = (int|null) : Here goes the logged in user's ID.       |       null when GUEST 
 * 
 * 
 *
 *  
 */

class SessionManager {

    private int $inactivityTimeout = 1800; // 30m       60*30

    public function __construct() {
        // Start session with secure settings if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params([
                'lifetime' => 0,
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax',
                'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' //Adaptively turn on when HTTPS is available
            ]);
            session_start();
        }
        $this->verifySessionSecurity();
        // Initialize session variables for guest users
        $this->initGuest();
    }

    // Hijacking security and inactivity timeout
    private function verifySessionSecurity(): void {
        $currentUserAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        
        if (!isset($_SESSION['user_agent'])) {
            $_SESSION['user_agent'] = $currentUserAgent;
        } 
        elseif ($_SESSION['user_agent'] !== $currentUserAgent) {
            // If $currentUserAgent doesn't match it means hijacking is probable
            $this->logout();
            return;
        }

        // Timeout check
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $this->inactivityTimeout)) {
            $this->logout();
            return;
        }
        
        // Update last activity with current time.
        $_SESSION['last_activity'] = time();
    }


    private function initGuest(): void {
        if (!isset($_SESSION['role'])) {
            $_SESSION['role'] = 'GUEST';
            $_SESSION['user_id'] = null;
        }
    }

    // Login
    public function login(int $userId): void {
        // Clear guest ID
        session_regenerate_id(true);
        
        $_SESSION['role'] = 'USER';
        $_SESSION['user_id'] = $userId;
    }

    // Logout
    public function logout(): void {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }

    // Check if logged in
    public function isLoggedIn(): bool {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'USER';
    }

    // Check if not logged in - added only for code readability 
    public function isGuest(): bool {
        return !$this->isLoggedIn();
    }

    // Get user ID from session - null if not logged in
    public function getUserId(): ?int {
        return $_SESSION['user_id'] ?? null;
    }

}