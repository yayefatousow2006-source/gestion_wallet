<?php

require_once __DIR__ . "/../services/WalletService.php";

final class WalletController
{
    public static function index()
    {
        $message = "";

        if (isset($_POST["creer"])) {
            $message = WalletService::creerWallet(
                $_POST["nom"],
                $_POST["prenom"],
                $_POST["telephone"],
                $_POST["code"],
                $_POST["solde"]
            );
        }

        if (isset($_POST["depot"])) {
            $message = WalletService::faireDepot(
                $_POST["telephoneDepot"],
                $_POST["montantDepot"]
            );
        }

        if (isset($_POST["retrait"])) {
            $message = WalletService::faireRetrait(
                $_POST["telephoneRetrait"],
                $_POST["montantRetrait"]
            );
        }

        $transactions = WalletService::listerTransactions();

        require_once __DIR__ . "/../view/wallet.view.php";
    }
}
