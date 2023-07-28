<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/DatabaseConnector.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/ProductRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/AuthorizationService.php";


class ProductService
{
    // здесь можно расширить функционал findAllUsersList,
    // например добавить возможность пагинации

    public function getProductsListIdNameEmailDto($token) {
        $databaseConnector = new DatabaseConnector();
        $productRepository = new ProductRepository($databaseConnector);
//        echo " findUsersList ";
        /*TODO добавить в проект DTOшки на случай сложных запросов
           с вложеенными объектами, когда придётся делать несколько запросов к бд
            (да, таких в итоговом проекте не будет, но на будущее) */
        $authorizationService = new AuthorizationService();
        $responseFromDb["account"] = json_decode($authorizationService->getUserDataByToken($token));

        $responseFromDb["products"] = $productRepository->findAll();

        return json_encode($responseFromDb);
    }
}