<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/DatabaseConnector.php";

class AuthorizationRepository
{
    private DatabaseConnector $databaseConnector;
    public function __construct(DatabaseConnector $databaseConnector)
    {
        // выяснить доступ по ссылке на объект или копируется из констракта
        $this->databaseConnector = $databaseConnector;
    }

    public function findUserIdByEmailAndPassword(string $email, string $password) {
        $userId = $this->databaseConnector->connect->query(
            "SELECT id from users
                WHERE email='$email' AND password='$password'"
        )->fetch_assoc();
        return $userId;
    }

    public function findUserNameByToken($token) {
        $user = $this->databaseConnector->connect->query(
            "SELECT name FROM users JOIN bearer_tokens
                ON bearer_tokens.user_id = users.id
                WHERE bearer_tokens.token = '$token'"
        )->fetch_assoc();
        return $user;
    }

    public function putToken($user_id, $token) {
        $this->databaseConnector->connect->query(
            "INSERT INTO bearer_tokens(user_id, token) 
                 VALUES ('$user_id', '$token')"
        );
    }
}