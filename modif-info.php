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

    if(isset($_POST['nom'])) {
        modifInfo();
    }


    ?>

    <body>
        <h3 class="text-center text-danger p-3">Modifier mes informations</h4>
            <div class="text-center">
                    <form class="p-4" action="./modif-info.php" method="POST">
                    <label class="text-center p-1">Prénom : <input value="<?php echo $_SESSION['prenom'] ?>" type="text" name="nom" required></label>
                    <label class="p-1">Nom : <input value="<?php echo $_SESSION['nom'] ?>" type="text" name="prenom" required></label>
                    <label class="p-1">E-mail : <input value="<?php echo $_SESSION['email'] ?>" type="text" name="email" required></label>
                    <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Valider les changements</button>
                </form>
            </div>
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-4">
                        <form class="p-3" action="./modif-adresse.php" method="POST"><button type="submit" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Modifier mon adresse</button></form>
                    </div>
                    <div class="col-md-4">
                        <form class="p-3" action="./modif-mdp.php" method="POST"><button type="submit" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Modifier mon mot de passe</button></form>
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