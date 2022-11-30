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

    if (isset($_POST['adresse'])) {
        modifAdresse();
    }
    ?>

    <body>
        <h3 class="text-center text-danger p-3">Modifier mon adresse</h4>
            <div class="text-center">
                <form class="p-4" action="./modif-adresse.php" method="POST">
                    <label class="p-1">Adresse : <input value="<?php echo $_SESSION['adresse'] ?>" type="text" name="adresse" required></label>
                    <label class="p-1">Code postal : <input value="<?php echo $_SESSION['code_postal'] ?>" type="text" name="code_postal" required></label>
                    <label class="p-1">Ville : <input value="<?php echo $_SESSION['ville'] ?>" type="text" name="ville" required></label>
                    <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
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