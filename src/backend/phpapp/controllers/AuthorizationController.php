<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/AuthorizationService.php";

class AuthorizationController
{
//    static function authorizeUserGet(): string {
//        return "pafim/profiles/register";
//    }

    static function loginUserPost(stdClass $requestData): string {
        /*
        * итак, логин/регистрация такие: в сервисе
        * после всех процедур возвращаем токен и имя Фронту + данные с settings
        *
        * при попытке подключиться к settings фронт перекидывает на логин/регистрацию.
        *
        * а при авторизации (при попытке подсоединиться
        * к любым другим страницам) - попробовать
        * получить токен и сравнить его в базе данных, если неудача,
        * то ничего не отправляем (так же попробовать момент с сессиями и куки
        * Так сказать, а как работать на них, альтернативный вариантик работы).
        *
        * Если есть токен в базе, то отлично отправляем при любом
        * запросе дополнительно и данные профиля
        *
        */
        // * TODO возможно стоит добавить парсер stdClass $requestData 1 *
        $authorizationService = new AuthorizationService();
        return $authorizationService->getUserNameTokenDtoByEmailAndPassword($requestData);
    }

    static function registerUserPost(stdClass $requestData): string {
        // * TODO возможно стоит добавить парсер stdClass $requestData в class 2 *
        $authorizationService = new AuthorizationService();
        return $authorizationService->getUserNameTokenDtoByRegistrationData($requestData);
    }
}