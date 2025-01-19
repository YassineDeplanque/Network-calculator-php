<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Résultats du Réseau</title>
<link href="style.css" rel="stylesheet" />
</head>
<body>
<h2>Entrer l'ip et le cidr</h2>
<form action="" method="POST">
<table>
<tbody>
<tr>
<td>
<label>Adresse IP :</label></td><td><input type="text" name="ip" required
placeholder="Adresse ip" class="form"><br>
</td>
</tr>
<tr>
<td>
<label>CIDR :</label></td><td><input type="text" name="cidr" required
placeholder="Cidr entre 0 et 32" class="form"><br>
</td>
</tr>
</tbody>
</table>
<input type="submit" value="Envoyer" class="btn"> <br>
</form>
<?php
require_once('class_reseau.php');
if (isset($_POST["ip"]) && isset($_POST["cidr"])) {
$ip = htmlspecialchars($_POST["ip"]);
$cidr = htmlspecialchars($_POST["cidr"]);
$adresseip = new classReseau($ip, $cidr);
if ($adresseip->testIp() == 0) {
echo "Adresse ip invalide.";
die;
}
if ($adresseip->testCidr() == 0) {
echo "Cidr invalide.";
die;
} else {
echo "<br>" . "<hr>";
}
$resultat = array(
"Adresse IP" => $adresseip->getIp(),
"CIDR" => $adresseip->getCidr(),
"Masque" => $adresseip->getDecMask(),
"Adresse réseau" => $adresseip->getAddressReseau(),
"Adresse de broadcast" => $adresseip->getAdressBroad(),
"Première adresse" => $adresseip->getFirstAdress(),
"Dernière adresse" => $adresseip->getLastAdress(),
"Nombre d'hôtes" => $adresseip->getNbreAdress(),
);
} else {
echo "Complétez";
}
?>
<h2>Résultat :</h2>
<table border="1">
<tr>
<th>Nom de la fonction</th>
<th>Résultat</th>
</tr>
<?php
if(isset($resultat)){
foreach ($resultat as $function => $res) {
echo "<tr><td>$function</td><td>$res</td></tr>";
}
}
?>
</table>
</body>
</html>