<?php

require_once __DIR__ . "/../repository/WalletRepository.php";

final class WalletService
{
    public static function creerWallet($nom, $prenom, $telephone, $code, $solde)
    {
        if ($nom == "" || $prenom == "" || $telephone == "" || $code == "") {
            return "Tous les champs obligatoires doivent être remplis.";
        }

        if ($solde < 0) {
            return "Le solde doit être positif ou nul.";
        }

        if (WalletRepository::findWalletByTelephone($telephone)) {
            return "Ce téléphone existe déjà.";
        }

        if (WalletRepository::findWalletByCode($code)) {
            return "Ce code existe déjà.";
        }

        WalletRepository::createWallet($nom, $prenom, $telephone, $code, $solde);
        return "Wallet créé avec succès.";
    }

    public static function faireDepot($telephone, $montant)
    {
        if ($telephone == "" || $montant <= 0) {
            return "Téléphone invalide ou montant incorrect.";
        }

        $wallet = WalletRepository::findWalletByTelephone($telephone);

        if (!$wallet) {
            return "Aucun wallet trouvé avec ce téléphone.";
        }

        $nouveauSolde = $wallet["solde"] + $montant;

        WalletRepository::updateSolde($telephone, $nouveauSolde);
        WalletRepository::addTransaction("DEP" . time(), $montant, "Depot", $wallet["id"]);

        return "Dépôt effectué avec succès.";
    }

    public static function faireRetrait($telephone, $montant)
    {
        if ($telephone == "" || $montant <= 0) {
            return "Téléphone invalide ou montant incorrect.";
        }

        $wallet = WalletRepository::findWalletByTelephone($telephone);

        if (!$wallet) {
            return "Aucun wallet trouvé avec ce téléphone.";
        }

        $frais = $montant * 0.01;

        if ($frais > 5000) {
            $frais = 5000;
        }

        $total = $montant + $frais;

        if ($wallet["solde"] < $total) {
            return "Solde insuffisant.";
        }

        $nouveauSolde = $wallet["solde"] - $total;

        WalletRepository::updateSolde($telephone, $nouveauSolde);
        WalletRepository::addTransaction("RET" . time(), $montant, "Retrait", $wallet["id"]);

        return "Retrait effectué avec succès. Frais : " . $frais . " CFA";
    }

    public static function listerTransactions()
    {
        return WalletRepository::getTransactions();
    }
}