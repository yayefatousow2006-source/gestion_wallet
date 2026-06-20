<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Wallet</title>
</head>
<body>

<h1>Gestion de Wallet</h1>

<?php if (!empty($message)) { ?>
    <p><?php echo $message; ?></p>
<?php } ?>

<h2>Créer une Wallet</h2>

<form method="POST">
    <input type="text" name="nom" placeholder="Nom"><br><br>
    <input type="text" name="prenom" placeholder="Prénom"><br><br>
    <input type="text" name="telephone" placeholder="Téléphone"><br><br>
    <input type="text" name="code" placeholder="Code"><br><br>
    <input type="number" step="0.01" name="solde" placeholder="Solde"><br><br>
    <button type="submit" name="creer">Créer Wallet</button>
</form>

<hr>

<h2>Faire un Dépôt</h2>

<form method="POST">
    <input type="text" name="telephoneDepot" placeholder="Téléphone"><br><br>
    <input type="number" step="0.01" name="montantDepot" placeholder="Montant"><br><br>
    <button type="submit" name="depot">Faire Dépôt</button>
</form>

<hr>

<h2>Faire un Retrait</h2>

<form method="POST">
    <input type="text" name="telephoneRetrait" placeholder="Téléphone"><br><br>
    <input type="number" step="0.01" name="montantRetrait" placeholder="Montant"><br><br>
    <button type="submit" name="retrait">Faire Retrait</button>
</form>

<hr>

<h2>Liste des Transactions</h2>

<table border="1">
    <tr>
        <th>Code</th>
        <th>Montant</th>
        <th>Date</th>
        <th>Type</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Téléphone</th>
    </tr>

    <?php foreach ($transactions as $transaction) { ?>
        <tr>
            <td><?php echo $transaction["code"]; ?></td>
            <td><?php echo $transaction["montant"]; ?></td>
            <td><?php echo $transaction["date_heure"]; ?></td>
            <td><?php echo $transaction["type"]; ?></td>
            <td><?php echo $transaction["nom"]; ?></td>
            <td><?php echo $transaction["prenom"]; ?></td>
            <td><?php echo $transaction["telephone"]; ?></td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
