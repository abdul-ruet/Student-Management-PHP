<?php
declare(strict_types=1);

class SessionManager {
    public static function set(string $key, $value): void {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }

    public static function isLoggedIn(): bool {
        return isset($_SESSION['user']);
    }

    public static function requireLogin(): void {
        if (!self::isLoggedIn()) {
            header('Location: index.php');
            exit;
        }
    }

    public static function destroy(): void {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }
        session_destroy();
    }
}
