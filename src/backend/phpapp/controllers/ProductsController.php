<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/services/ProductService.php";

class ProductsController
{
    private static ProductService $productService;

    static function showProductsList(): string {
        self::$productService = new ProductService();
        return self::$productService->getProductsListIdNameEmailDto();
    }
}