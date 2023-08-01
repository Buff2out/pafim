<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/DatabaseConnector.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/AuthorizationRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/dto/UserNameTokenDto.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/ProductService.php";

class AuthorizationService
{
    //TODO а зачем в сервисах $databaseConnector ???
    // чем я думал, он же тут лишний, он нужен только для repository.
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
//             echo http_response_code(400) . " input data incorrect\n";
            return json_encode(null);
        }
        // creating token
        $token = bin2hex(random_bytes(16));
        $authorizationRepository->putToken($responseFromDb["id"], $token);
        $userNameTokenDto = new UserNameTokenDto($responseFromDb["name"], $token); //

//        $productService = new ProductService();
//        // сервисы по идее не должны возвращать Json формат(string),
//        // а должны возвращать объект,
//        // и лишние json_decode - это да потеря производительности,
//        // но так как я тороплюсь,
//        // то оставлю пока так. Так же и с dto'шками,
//        // которые я не успею доделать и обойдусь
//        // stdClass'ом
//        $userNameTokenDto->products = json_decode($productService->getProductsListIdNameEmailDto($token));

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
//        $databaseConnector = new DatabaseConnector();
        if (is_null($token))
        {
            return null; // can't get token from headers
        }
        $authorizationRepository = new AuthorizationRepository($this->databaseConnector);
        $responseFromDb = $authorizationRepository->findUserNameByToken($token);
        if (is_null($responseFromDb))
        {
            return null; // invalid token or doesn't exist in DB;
        }
        return json_encode($responseFromDb);

    }
}