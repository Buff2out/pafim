<?php

class RequestReciever
{
    private static $urlList;
    private static $requestData;

    public static function toProcessRequest(): string {
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
        self::$urlList = self::getUrlList();
        switch (self::$urlList[0]) {
            case "login":
                return json_encode(self::$urlList);
                break;
            case "":
                return json_encode(self::$urlList);
                break;
            case "register":
                return json_encode(self::$urlList);
                break;
        }
        return "jsonResponse";
    }

    private static function toProcessPost(): string
    {
        self::$urlList = self::getUrlList();
        self::$requestData = self::getBody(self::getMethod());
        switch (self::$urlList[0]) {
            case "0":
                return json_encode(self::$requestData);
                break;
            case "1":
                return json_encode(self::$requestData);
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