<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/DatabaseConnector.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/dto/UsersListThreeFieldsDto.php";

class UserRepository
{
    private DatabaseConnector $databaseConnector;
    public function __construct(DatabaseConnector $databaseConnector)
    {
        // выяснить доступ по ссылке на объект или копируется из констракта
        $this->databaseConnector = $databaseConnector;
    }

//    public $connect;
    public function findUsersListThreeFields()
    {
//        echo " findUsersListThreeFields ";
        $result = mysqli_fetch_all($this->databaseConnector->connect->query(
            "SELECT id, name, email FROM users"
        ), MYSQLI_ASSOC);
        return $result;
    }
}