<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/DatabaseConnector.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/ProductRepository.php";

class ProductService
{
    // здесь можно расширить функционал findAllUsersList,
    // например добавить возможность пагинации

    public function getProductsListIdNameEmailDto() {
        $databaseConnector = new DatabaseConnector();
        $productRepository = new ProductRepository($databaseConnector);
//        echo " findUsersList ";
        /*TODO добавить в проект DTOшки на случай сложных запросов
           с вложеенными объектами, когда придётся делать несколько запросов к бд
            (да, таких в итоговом проекте не будет, но на будущее) */
        $responseFromDb = $productRepository->findAll();
        return json_encode($responseFromDb);
    }
}