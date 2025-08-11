<?php
declare(strict_types=1);

class User {
    private FileManager $fm;

    public function __construct() {
        $this->fm = new FileManager(DATA_PATH . '/users.json');
    }

    public function authenticate(string $email, string $password): ?array {
        $users = $this->fm->read();
        foreach ($users as $u) {
            if (strtolower($u['email']) === strtolower($email) && $u['password'] === $password) {
                return $u;
            }
        }
        return null;
    }
}
