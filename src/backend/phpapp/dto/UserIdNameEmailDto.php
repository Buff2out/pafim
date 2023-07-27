<?php

class UserIdNameEmailDto
{
    public $id;
    public $name;
    public $email;
    public function __construct(int $id, string $name, string $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

}