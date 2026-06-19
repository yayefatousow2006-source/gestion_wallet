<?php

require_once __DIR__ . "/../controller/WalletController.php";

final class Routter
{
    public static function run()
    {
        WalletController::index();
    }
}