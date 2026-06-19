<?php

final class WalletRepository
{
    public static function connexion()
    {
        return new PDO(
            "mysql:host=127.0.0.1;dbname=gestion_wallet;port=3306;charset=utf8",
            "root",
            ""
        );
    }

    public static function findWalletByTelephone($telephone)
    {
        $pdo = self::connexion();
        $sql = "SELECT * FROM wallet WHERE telephone = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$telephone]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findWalletByCode($code)
    {
        $pdo = self::connexion();
        $sql = "SELECT * FROM wallet WHERE code = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function createWallet($nom, $prenom, $telephone, $code, $solde)
    {
        $pdo = self::connexion();
        $sql = "INSERT INTO wallet(nom, prenom, telephone, code, solde) VALUES(?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$nom, $prenom, $telephone, $code, $solde]);
    }

    public static function updateSolde($telephone, $solde)
    {
        $pdo = self::connexion();
        $sql = "UPDATE wallet SET solde = ? WHERE telephone = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$solde, $telephone]);
    }

    public static function addTransaction($code, $montant, $type, $walletId)
    {
        $pdo = self::connexion();
        $sql = "INSERT INTO `transaction`(code, montant, date_heure, type, wallet_id) VALUES(?, ?, NOW(), ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$code, $montant, $type, $walletId]);
    }

    public static function getTransactions()
    {
        $pdo = self::connexion();
        $sql = "SELECT t.*, w.nom, w.prenom, w.telephone 
                FROM `transaction` t
                JOIN wallet w ON w.id = t.wallet_id
                ORDER BY t.id DESC";
        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}