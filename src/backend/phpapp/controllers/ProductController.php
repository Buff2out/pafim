<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/services/ProductService.php";

class ProductController
{
    private static ProductService $productService;

    static function showProductsList($token): string {
        self::$productService = new ProductService();
        return self::$productService->getProductsListIdNameEmailDto($token);
    }
}