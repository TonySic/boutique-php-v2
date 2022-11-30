<?php
    session_start();

    include './functions.php';
    
    creationPanier();

   
    if (isset($_POST["validCommande"])) {
        viderPanier();
    }

    if (isset($_POST["email"])) {
        connexion();
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <?php
        include './head.php';
    ?>

<body>
    <?php
            if (isset($_POST['deconnexion'])) {
                deconnexion();
            }
            include './header.php';
            ?>
    <div class="container">
        <div class="row">

            <?php $articles = getArticles();
            showArticles($articles)?>
        </div>
    </div>
</body>

<?php
    include './footer.php';
?>

</html>
