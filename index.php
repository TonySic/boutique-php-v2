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
            ?>
    <div class="container">
        <div class="row">
            <?php showArticles() ?>
        </div>
    </div>
</body>

<?php
    include './footer.php';
?>

</html>
