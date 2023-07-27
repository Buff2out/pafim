<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/DatabaseConnector.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/AuthorizationRepository.php";

class AuthorizationService
{
    public function getUserIdByEmailAndPassword(stdClass $requestData) {
        $databaseConnector = new DatabaseConnector();
        $authorizationRepository = new AuthorizationRepository($databaseConnector);

        $responseFromDb = $authorizationRepository->findUserIdByEmailAndPassword($requestData->email, $requestData->password);
        if (is_null($responseFromDb))
        {
            echo http_response_code(400) . " input data incorrect\n";
            return null;
        }
        // creating token
        $token = bin2hex(random_bytes(16));
        $authorizationRepository->putToken($responseFromDb, $token);
        return $responseFromDb; // фронту токен не забыть вернуть
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