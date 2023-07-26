<?php

class AuthorizationController
{
    static function authorizeUserGet(): string {
        return "pafim/profiles/register";
    }

    static function loginUserPost(): string {
        return "pafim/login";
    }

    static function registerUserPost(): string {
        return "pafim/register";
    }
}