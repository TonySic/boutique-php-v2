<?php
session_start();
include './functions.php';
creationPanier();
if (isset($_POST["validCommande"])) {
    viderPanier();
}
?>
<!DOCTYPE html>
<html lang="fr">
<?php
include './head.php';
?>

<body>
    <?php
    include './header.php';

    if (isset($_POST['code_postal'])) {
        inscription();
    }

    ?>
    <div class="container-fluid">
        <div class="row text-left p-2">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <h4 class="text-danger">Nouveau client ?</h4>
                <p>Veuillez remplir ce formulaire</p>
                <form action="./inscription.php" method="post">
                    <label class="p-1">Nom : <input type="text" name="nom" required></label>
                    <label class="p-1">Prénom : <input type="text" name="prenom" required></label>
                    <label class="p-1">Adresse : <input type="text" name="adresse" required></label>
                    <label class="p-1">Code postal : <input type="text" name="code_postal" required></label>
                    <label class="p-1">Ville : <input type="text" name="ville" required></label>
                    <label class="p-1">E-mail : <input type="text" name="email" required></label>
                    <label class="p-1">Mot de passe : <input type="password" name="mot_de_passe" required></label>
                    <p class="p-1"><input action="./index.php" type="submit" value="Inscription"></p>
                </form>
            </div>
            <div class="col-md-4">
                <h4 class="text-danger">Déjà client ?</h5>
                    <p class="font-italic">Connectez-vous ci-dessous...</p>
                    <form action="./index.php" method="post">
                        <label class="p-1">E-mail : <input type="email" name="email" required></label>
                        <label class="p-1">Mot de passe : <input type="password" name="mot_de_passe" required></label>
                        <p class="p-1"><input type="submit" value="Connexion"></p>
                    </form>
                    <div class="col-md-2"></div>
            </div>
        </div>
</body>

<?php
include './footer.php';
?>