<?php

class UserNameTokenDto
{
    public $name;
    public $token;
//    public $products;
    public function __construct(string $name, string $token) {
        $this->name = $name;
        $this->token = $token;
//        $this->products = [];
    }
}