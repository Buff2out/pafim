<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/DatabaseConnector.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/UserRepository.php";

class UserService
{
    // здесь можно расширить функционал findAllUsersList,
    // например добавить возможность пагинации

    public function findUsersList() {
        $databaseConnector = new DatabaseConnector();
        $userRepository = new UserRepository($databaseConnector);
//        echo " findUsersList ";
        /*TODO добавить в проект DTOшки на случай сложных запросов
           с вложеенными объектами, когда придётся делать несколько запросов к бд
            (да, таких в итоговом проекте не будет, но на будущее) */
        $responseFromDb = $userRepository->findUsersListThreeFields();
        return json_encode($responseFromDb);
    }
}