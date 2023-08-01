<?php
    require_once "RequestReciever.php";

//     header('Access-Control-Allow-Origin: *');
//
//     header('Access-Control-Allow-Methods: GET, POST');
//
//     header("Access-Control-Allow-Headers: X-Requested-With");
    header('content-type: application/json');
//    echo " index.php ";
    echo RequestReciever::toProcessRequestMethod();