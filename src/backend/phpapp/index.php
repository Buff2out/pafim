<?php
    require_once "RequestReciever.php";
    header('content-type: application/json');
    echo RequestReciever::toProcessRequest();