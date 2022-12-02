<?php
session_start();
include './functions.php';

// on vérifie que l'on vient de détails produit
if (isset($_POST["chosenArticle"])) {
  $idArticleAjout = $_POST["chosenArticle"];
  $article = getArticleFromId($idArticleAjout);
  ajoutArticle($article);
}

if (isset($_POST["suppIdArticle"])) {
  suppressionArticle();
}

if (isset($_POST["modifQuantite"])) {
  modifQuantite();
}

if (isset($_POST["vider-panier"])) {
  viderPanier();
}
?>

<!DOCTYPE html>
<html lang="fr" <?php
                include './head.php'; ?> <?php
                                          include './header.php';
                                          if (isset($_POST['adresse'])) {
                                            modifAdresse();
                                          }
                                          if (isset($_POST['nom'])) {
                                            modifInfo();
                                          }
                                          ?> <main>
<?php
afficherPanier(); ?>

<p class="text-center">Total des articles : <?= totalArticles() ?> €</p>
<p class="text-center">Frais de livraison (5€/maillot) : <?= livraison() ?> €</p>
<p class="text-center">Total de la commande : <?php
                                              $totalGeneral = totalArticles() + livraison();
                                              echo $totalGeneral
                                              ?> €</p>

<h3 class="text-center text-danger p-3">Mon adresse de livraison</h4>
  <div class="text-center">
    <form class="p-4" action="./panier.php" method="POST">
      <label class="p-1">Adresse : <input value="<?php echo $_SESSION['adresse'] ?>" type="text" name="adresse" required></label>
      <label class="p-1">Code postal : <input value="<?php echo $_SESSION['code_postal'] ?>" type="text" name="code_postal" required></label>
      <label class="p-1">Ville : <input value="<?php echo $_SESSION['ville'] ?>" type="text" name="ville" required></label>
      <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Valider les changements</button>
    </form>
  </div>

  <h3 class="text-center text-danger p-3">Mes coordonnées</h4>
    <div class="text-center">
      <form class="p-4" action="./panier.php" method="POST">
        <label class="text-center p-1">Prénom : <input value="<?php echo $_SESSION['prenom'] ?>" type="text" name="prenom" required></label>
        <label class="p-1">Nom : <input value="<?php echo $_SESSION['nom'] ?>" type="text" name="nom" required></label>
        <label class="p-1">E-mail : <input value="<?php echo $_SESSION['email'] ?>" type="text" name="email" required></label>
        <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Valider les changements</button>
      </form>
    </div>

    <!-- Button trigger modal -->
    <?php
    if (count($_SESSION['panier'])>0) {
      validation_commande(); ?>
      <div class="d-flex justify-content-center">
      <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#exampleModal">
        Valider la commande ! 
      </button>
    </div>
    <?php } ?>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Merci pour votre commande !</h1>
          </div>
          <div class="modal-body">
            <p>Total de la commande : <?php echo $totalGeneral ?> €</p>
          </div>
          <div class="modal-footer">
            <form action="./index.php" method="POST">
              <button type="submit" name="validCommande" class="btn btn-secondary">Retour à l'accueil</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-center p-3">
      <form action="./panier.php" method="POST">
        <input type="hidden" name="vider-panier">
        <button type="submit" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Vider le panier !
        </button>
      </form>
    </div>

    </main>

    <?php
    include './footer.php';
    ?>