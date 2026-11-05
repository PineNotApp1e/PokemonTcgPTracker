<?php
namespace App\Models;
use App\Services\Database;
use PDO;
class Equipes
{
    private PDO $pdoConnection;
    public static function findAll(): array
    {
        $pdo = Database::getConnection();
        $statement = $pdo->query('SELECT id, pays FROM equipes ORDER BY id');
        $rows = $statement->fetchAll();
        $equipes = [];
        foreach ($rows as $row) {
            $equipes[] = new self($row['id'], $row['pays']);
        }
        return $equipes;
    }
}
