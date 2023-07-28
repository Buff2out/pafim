<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/UserController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/ProductController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/AuthorizationController.php";

class RequestReciever
{
    private static $urlList;
    private static $requestData;
    private static $token;

    public static function toProcessRequestMethod(): string {
        self::$urlList = self::getUrlList();
        self::$requestData = self::getBody(self::getMethod());
        self::$token = explode(" ", getallheaders()['Authorization'])[1];
        switch (self::getMethod()) {
            case "GET":
                return self::toProcessGet();
                break;
            case "POST":
                return self::toProcessPost();
                break;
        }
        return "errorOtherMethodRecieved";
    }

    private static function toProcessGet(): string {

        switch (self::$urlList[0]) {
            case "products":
                return ProductController::showProductsList(self::$token);
                break;
            case "users":
//                echo " toProcessGet ";
                return UserController::showUsersListGet(self::$token);
                break;
            case "":
                return json_encode(self::$urlList);
                break;
            case "register":
                return json_encode(self::$urlList);
                break;
        }
        return "bad request 400 statuscode (TODO)";
    }

    private static function toProcessPost(): string
    {
        switch (self::$urlList[0]) {
            case "login":
                return AuthorizationController::loginUserPost(self::$requestData);
                break;
            case "register":
                return AuthorizationController::registerUserPost(self::$requestData);
                break;
        }
        return json_encode(self::$requestData);
    }

    private static function getUrlList(): array
    {
        $url = isset($_GET['q']) ? $_GET['q'] : '';
        $url = rtrim($url, '/');
        $urlList = explode('/', $url);
        return $urlList;
    }

    private static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    private static function getBody($method)
    {
        $data = new stdClass();
        if ($method != "GET")
        {
            #echo "POSTMETHOD\n";
            $data->body = json_decode(file_get_contents("php://input"));
        }
        $data->parameteres = [];
        $dataGet = $_GET;
        foreach ($dataGet as $key => $value)
        {
            if ($key != 'q')
            {
                $data->parameteres[$key] = $value;
            }
        }
        return $data;
    }
}