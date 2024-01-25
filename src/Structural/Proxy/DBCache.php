<?php

namespace App\Structural\Proxy;

use DateTime;
use PDO;

class DBCache implements CacheInterface
{
    private PDO $pdo;
    private int $ttl = 3600;
    
    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=dictionary;charset=utf8', 'root', '1111', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
    
    public function set(string $key, $value, int $ttl = null): void
    {
        $expiresAt = $this->getFormattedDateTime($ttl ?? $this->ttl);
        
        $stmt = $this->pdo->prepare("
            INSERT INTO od_response_cache (query, data, expires_at) VALUES (:query, :data, :expiresAt)
            ON DUPLICATE KEY UPDATE data = :data, expires_at = :expiresAt
        ");
        $stmt->execute([
            ':query' => $key,
            ':data' => json_encode($value),
            ':expiresAt' => $expiresAt
        ]);
    }
    
    public function get(string $key)
    {
        $sql = "SELECT data FROM od_response_cache WHERE query = :query AND expires_at > NOW()";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':query' => $key]);
        $result = $stmt->fetch();
        
        return $result ? json_decode($result['data'], true) : null;
    }
    
    public function has(string $key): bool
    {
        $sql = "SELECT COUNT(*) FROM od_response_cache WHERE query = :query AND expires_at > NOW()";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':query' => $key]);
        
        return $stmt->fetchColumn() > 0;
    }
    
    public function delete(string $key): void
    {
        $sql = "DELETE FROM od_response_cache WHERE query = :query";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':query' => $key]);
    }
    
    private function getFormattedDateTime(int $ttl): string
    {
        return (new DateTime())->modify("+{$ttl} seconds")->format('Y-m-d H:i:s');
    }
}