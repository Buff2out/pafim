<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/DatabaseConnector.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/AuthorizationRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/dto/UserNameTokenDto.php";

class AuthorizationService
{
    private DatabaseConnector $databaseConnector;
    public function __construct() {
        $this->databaseConnector = new DatabaseConnector();
    }

    public function getUserNameTokenDtoByEmailAndPassword(stdClass $requestData) {
//        $databaseConnector = new DatabaseConnector();
        $authorizationRepository = new AuthorizationRepository($this->databaseConnector);

        $responseFromDb = $authorizationRepository->findUserIdAndNameByEmailAndPassword($requestData->body->email, hash("sha1", $requestData->body->password));

        if (is_null($responseFromDb))
        {
            echo http_response_code(400) . " input data incorrect\n";
            return null;
        }
        // creating token
        $token = bin2hex(random_bytes(16));
        $authorizationRepository->putToken($responseFromDb["id"], $token);
        $userNameTokenDto = new UserNameTokenDto($responseFromDb["name"], $token); //
        return json_encode($userNameTokenDto); // фронту токен не забыть вернуть
    }

    public function getUserNameTokenDtoByRegistrationData(stdClass $requestData) {
//        $databaseConnector = new DatabaseConnector();
        $authorizationRepository = new AuthorizationRepository($this->databaseConnector);

//        $responseFromDb = $authorizationRepository->findUserIdByEmailAndPassword($requestData->email, $requestData->password);
        $authorizationRepository->putNewUser($requestData->body->email, $requestData->body->name, hash("sha1", $requestData->body->password));
//        if (is_null($responseFromDb))
//        {
//            echo http_response_code(400) . " input data incorrect\n";
//            return null;
//        }
        // creating token
//        $token = bin2hex(random_bytes(16));
//        $authorizationRepository->putToken($responseFromDb, $token);
//        $userNameTokenDto = new UserNameTokenDto($responseFromDb, $token);
        return $this->getUserNameTokenDtoByEmailAndPassword($requestData); // фронту токен не забыть вернуть
    }

    public function getUserDataByToken($token) {
        $databaseConnector = new DatabaseConnector();
        if (is_null($token))
        {
            return null; // can't get token from headers
        }
        $authorizationRepository = new AuthorizationRepository($databaseConnector);
        $responseFromDb = $authorizationRepository->findUserNameByToken($token);
        if (is_null($responseFromDb))
        {
            return null; // invalid token or doesn't exist in DB;
        }
        return $responseFromDb;

    }
}