<?php
namespace App\Models;
use App\Services\Database;
use PDO;
class User
{
    private PDO $pdoConnection;
    public static function UserCreate($username, $email, $user_passeword, $user_friend_id, $user_level)
    {
        $pdo = Database::getConnection();
        $erreur = false;
        try {
            $sql = "INSERT INTO user (username,email,user_passeword,user_friend_id,user_level) VALUES (?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $email, $user_passeword, $user_friend_id, $user_level]);


        } catch (PDOException $e) {
            $erreur = true;
        }
        return $erreur;
    }
    public static function find($email)
    {
        $pdo = Database::getConnection();
        $statement = $pdo->prepare('SELECT username,email,user_passeword,user_friend_id,user_level FROM user WHERE email like ?');
        $statement->execute([$email]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function Connection($email,$password): bool
    {
        $pass = User::find($email);
        return password_verify($password,$pass[0]['user_passeword']);

    }
}