<?php
/**
 * Database Singleton & Query Helper
 */

require_once __DIR__ . '/../../config/database.php';

class Database {
    private static ?Database $instance = null;
    private ?PDO $pdo = null;
    private $stmt = null;

    private function __construct() {
        try {
            $this->pdo = new PDO(
                DatabaseConfig::getDsn(),
                DB_USER,
                DB_PASS,
                DatabaseConfig::getOptions()
            );
        } catch (PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }

    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->pdo;
    }

    public function query(string $sql, array $params = []): self {
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute($params);
        return $this;
    }

    public function fetchAll(string $sql, array $params = []): array {
        $this->query($sql, $params);
        return $this->stmt->fetchAll();
    }

    public function fetch(string $sql, array $params = []): ?array {
        $this->query($sql, $params);
        $res = $this->stmt->fetch();
        return $res !== false ? $res : null;
    }

    public function execute(string $sql, array $params = []): bool {
        $this->stmt = $this->pdo->prepare($sql);
        return $this->stmt->execute($params);
    }

    public function lastInsertId(): string {
        return $this->pdo->lastInsertId();
    }

    public function rowCount(): int {
        return $this->stmt ? $this->stmt->rowCount() : 0;
    }
}
