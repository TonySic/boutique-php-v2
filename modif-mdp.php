<?php
session_start();
include './functions.php';
$gammes = getGammes();

?>
<!DOCTYPE html>
<html lang="fr">
<?php
include './head.php';
?>

<body>
    <?php
    include './header.php';

    if (isset($_POST['mot_de_passe'])) {
        modifMDP();
    }
    ?>

    <body>
        <h3 class="text-center text-danger p-3">Modifier mon mot de passe</h4>
            <div class="text-center">
                <form class="p-4" action="./modif-mdp.php" method="POST">
                    <label class="p-1">Ancien mot de passe : <input type="password" name="mot_de_passe" required></label>
                    <label class="p-1">Nouveau mot de passe : <input type="password" name="new_mot_de_passe" required></label>
                    <button type="submit" class="btn btn-danger">
                        Valider les changements</button>
                </form>
            </div>
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-4">
                        <form class="p-3" action="./modif-info.php" method="POST"><button type="submit" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Modifier mes informations</button></form>
                    </div>
                    <div class="col-md-4">
                        <form class="p-3" action="./modif-adresse.php" method="POST"><button type="submit" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Modifier mon adresse</button></form>
                    </div>
                    <div class="col-md-4">
                        <form class="p-3" action="./valid-commande.php" method="POST"><button type="submit" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Voir mes commandes</button></form>
                    </div>
                </div>
            </div>
    </body>

    <?php
    include './footer.php';
    ?>

</html>