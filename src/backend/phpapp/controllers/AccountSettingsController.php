<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/services/AccountSettingsService.php";

class AccountSettingsController
{
    static function showAccountSettingsGet($token): string {
        $accountSettingsService = new AccountSettingsService();
        return $accountSettingsService->getUserSettings($token);
    }

    static function setProfileSettingsPost($requestData, $token): string {
        $accountSettingsService = new AccountSettingsService();
        return $accountSettingsService->updateUserSettings($requestData, $token);
    }
}