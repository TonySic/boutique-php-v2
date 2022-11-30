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
    ?>
    <h3 class="text-center p-3">Mon compte</h3>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-3">
                <p><i class="fa-solid fa-user fa-3x"></i></p>
                <form action="./modif-info.php" method="POST"><button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Modifier mes informations</button></form>
            </div>
            <div class="col-md-3">
                <p><i class="fa-solid fa-key fa-3x"></i></p>
                <form action="./modif-mdp.php" method="POST"><button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Modifier mon mot de passe</button></form>
            </div>
            <div class="col-md-3">
                <p><i class="fa-solid fa-house-user fa-3x"></i></p>
                <form action="./modif-adresse.php" method="POST"><button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Modifier mon adresse</button></form>
            </div>
            <div class="col-md-3">
                <p><i class="fa-solid fa-cart-shopping fa-3x"></i></p>
                <form action="./voir-commande.php" method="POST"><button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Voir mes commandes</button></form>
            </div>
        </div>
    </div>
</body>

<?php
include './footer.php';
?>

</html>