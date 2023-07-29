<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/DatabaseConnector.php";

class AccountSettingsRepository
{
    private DatabaseConnector $databaseConnector;
    public function __construct()
    {
        // выяснить доступ по ссылке на объект или копируется из констракта
        $this->databaseConnector = new DatabaseConnector();
    }
    public function findUserSettingsByToken($token) {
        $userSettings = $this->databaseConnector->connect->query(
            "SELECT 
                pub_access_token, 
                transf_balances_chbx, 
                transf_prices_chbx 
                FROM users JOIN bearer_tokens
                ON bearer_tokens.user_id = users.id
                WHERE bearer_tokens.token = '$token'"
        )->fetch_assoc();
        return $userSettings;
    }

    public function updateUserSettingsAndReturnThem(
        $pub_access_token,
        $transf_balances_chbx,
        $transf_prices_chbx,
        $token
    ) {
        $this->databaseConnector->connect->query(
            "UPDATE users JOIN bearer_tokens
                   ON bearer_tokens.user_id = users.id
                   SET pub_access_token = '$pub_access_token',
                       transf_balances_chbx = '$transf_balances_chbx',
                       transf_prices_chbx = '$transf_prices_chbx'
                   WHERE bearer_tokens.token = '$token'");
        $userSettings = $this->databaseConnector->connect->query(
            "SELECT 
                pub_access_token, 
                transf_balances_chbx, 
                transf_prices_chbx 
                FROM users JOIN bearer_tokens
                ON bearer_tokens.user_id = users.id
                WHERE bearer_tokens.token = '$token'"
        )->fetch_assoc();
        return $userSettings;
    }

}