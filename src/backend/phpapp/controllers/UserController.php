<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/services/UserService.php";

class UserController
{
    private static UserService $userService;

    static function showUsersListGet(array $urlList): string {
//        echo " showUsersListGet ";
        self::$userService = new UserService();
        return self::$userService->getUsersListIdNameEmailDto();
    }
}