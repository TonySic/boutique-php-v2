<?php
    session_start();
    include './functions.php';
    $gammes=getGammes();



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
    <div class="container">
        <div class="row">
            
        <?php
        afficherPanier();?>

        <p class="text-center">Total des articles : <?=totalArticles()?> €</p>
        <p class="text-center">Frais de livraison (5€/maillot) : <?=livraison()?> €</p>
        <p class="text-center">Total de la commande : <?php
            $totalGeneral = totalArticles() + livraison();
            echo $totalGeneral
            ?> €</p>

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
        </div>
    </div>

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
</body>

<?php
    include './footer.php';
?>

</html>
