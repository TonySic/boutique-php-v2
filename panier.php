<?php
session_start();
include './functions.php';

// on vérifie que l'on vient de détails produit
if (isset($_POST["chosenArticle"])) {
    $idArticleAjout = $_POST["chosenArticle"];
    $article = getArticleFromId($idArticleAjout);
    ajoutArticle($article);}

if (isset($_POST["suppIdArticle"])) {
        suppressionArticle();}

if (isset($_POST["modifQuantite"])) {
        modifQuantite();
}

if (isset($_POST["vider-panier"])) {
        viderPanier();
}
?>

<!DOCTYPE html>
<html lang="fr" 
<?php
    include './head.php';?> 
<?php
include './header.php';
?>
<main>
<?php
afficherPanier();?>

<p class="text-center">Total des articles : <?=totalArticles()?> €</p>
<p class="text-center">Frais de livraison (5€/maillot) : <?=livraison()?> €</p>
<p class="text-center">Total de la commande : <?php
    $totalGeneral = totalArticles() + livraison();
    echo $totalGeneral
    ?> €</p>

<!-- Button trigger modal -->
<div class="d-flex justify-content-center">
<button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#exampleModal">
  Valider la commande !
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Merci pour votre commande !</h1>
      </div>
      <div class="modal-body">
        <p>Total de la commande : <?php echo $totalGeneral?> €</p>
      </div>
      <div class="modal-footer">
        <form action="./index.php" method="POST"> 
            <button type="submit" name="validCommande" class="btn btn-secondary" >Retour à l'accueil</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="d-flex justify-content-center p-3">
<form action= "./panier.php" method="POST">
    <input type="hidden" name="vider-panier">
<button type="submit" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Vider le panier !
</button></form>
</div>

</main>

<?php
include './footer.php';
?>