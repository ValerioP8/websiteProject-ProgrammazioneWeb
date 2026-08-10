<?php
namespace App\Service;

class SessionManager {
    public function __construct() {
        // Start session with secure settings if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params([
                'lifetime' => 0,
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
            session_start();
        }
        // Initialize session variables for guest users
        $this->initGuest();
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

    // Get user ID from session - null if not logged in
    public function getUserId(): ?int {
        return $_SESSION['user_id'] ?? null;
    }

}