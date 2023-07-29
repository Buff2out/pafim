<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/DatabaseConnector.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/dto/UserIdNameEmailDto.php";

class UserRepository
{
    private DatabaseConnector $databaseConnector;
    public function __construct(DatabaseConnector $databaseConnector)
    {
        // выяснить доступ по ссылке на объект или копируется из констракта
        $this->databaseConnector = new DatabaseConnector();
    }

//    public $connect;
    public function findUsersListIdNameEmail()
    {
//        echo " findUsersListThreeFields ";
        $result = mysqli_fetch_all($this->databaseConnector->connect->query(
            "SELECT id, name, email FROM users"
        ), MYSQLI_ASSOC);
        return $result;
    }

    public function findUserSettingsByUserId()
    {
//        echo " findUsersListThreeFields ";
        $result = mysqli_fetch_all($this->databaseConnector->connect->query(
            "SELECT 
                name, 
                pub_access_token, 
                transf_balances_chbx, 
                transf_prices_chbx FROM users"
        ), MYSQLI_ASSOC);
        return $result;
    }
}