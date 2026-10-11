<?php
/**
 * Model Admin
 * Table: admin (id_admin, username, password)
 */

require_once __DIR__ . '/Database.php';

class Admin {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        return $this->db->fetchAll("SELECT id_admin, username, created_at FROM `admin` ORDER BY id_admin ASC");
    }

    public function getById(int $id): ?array {
        return $this->db->fetch("SELECT id_admin, username, created_at FROM `admin` WHERE id_admin = ?", [$id]);
    }

    public function getByUsername(string $username): ?array {
        return $this->db->fetch("SELECT * FROM `admin` WHERE username = ?", [$username]);
    }

    public function create(string $username, string $password): bool {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        return $this->db->execute("INSERT INTO `admin` (username, password) VALUES (?, ?)", [$username, $hashed]);
    }

    public function update(int $id, string $username, ?string $password = null): bool {
        if (!empty($password)) {
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            return $this->db->execute("UPDATE `admin` SET username = ?, password = ? WHERE id_admin = ?", [$username, $hashed, $id]);
        }
        return $this->db->execute("UPDATE `admin` SET username = ? WHERE id_admin = ?", [$username, $id]);
    }

    public function delete(int $id): bool {
        return $this->db->execute("DELETE FROM `admin` WHERE id_admin = ?", [$id]);
    }

    public function count(): int {
        $res = $this->db->fetch("SELECT COUNT(*) as total FROM `admin`");
        return (int)($res['total'] ?? 0);
    }
}
