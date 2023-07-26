<?php

class DatabaseConnector
{
    public mysqli $connect;
    public function __construct() {
        $settings = json_decode(file_get_contents("../settings.json"));
        $this->connect = mysqli_connect(
            $settings->database->ip,
            $settings->database->login,
            $settings->database->password,
            $settings->database->name);
        if (!$this->connect) {
            echo "error can't connect to server" . PHP_EOL;
            echo "errno" . mysqli_connect_errno() . PHP_EOL;
            echo "error" . mysqli_connect_error() . PHP_EOL;
        }
//        echo "Success connecting to MariaDB" . PHP_EOL;
//        echo "Information " . mysqli_get_host_info($connect);
    }
}