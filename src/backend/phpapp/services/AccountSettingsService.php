<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/AccountSettingsRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/AuthorizationService.php";

class AccountSettingsService
{
    public function getUserSettings($token) {
        $accountSettingsRepository = new AccountSettingsRepository($token);
        $authorizationService = new AuthorizationService();
        $responseFromDb["account"] = json_decode($authorizationService->getUserDataByToken($token));
        $responseFromDb["accountSettings"] = $accountSettingsRepository->findUserSettingsByToken($token);
        return json_encode($responseFromDb);
    }
    public static function updateUserSettings($token) {

    }
}