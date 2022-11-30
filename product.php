<?php
session_start();
include './functions.php';

// on vérifie que l'on vient de détails produit
if (isset($_POST["idArticle"])) {
    $idArticle = $_POST["idArticle"];
    $article = getArticleFromId($idArticle);
}
?>

<!DOCTYPE html>
<html lang="fr">
    <?php
                include './head.php';
                ?> 
<?php
include './header.php';
?>
<main>
    <div class="container text-center">
        <div class="row" id="text-product">
            <img src="./images/<?= $article['image'] ?>" alt="Maillot" class="w-50 mx-auto"></p>
            <h3><?= $article["nom"] ?></h3>
            <h5><?= $article["description"] ?></h5>
            <p><?= $article["description_detaillee"] ?></p>
            <h5><?= $article["prix"] ?> €</h5>
            <form action="panier.php" method="post">
                <input type="hidden" name="chosenArticle" value="<?php echo $article['id']?>">            
                <input class="btn btn-dark mt-2" type="submit" value="Ajouter au panier">
            </form>
        </div>

    </div>
</main>


<?php
include './footer.php';
?>

</html>