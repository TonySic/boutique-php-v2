<?php

function creationPanier() {
    if (!isset($_SESSION["panier"])) {
        $_SESSION["panier"] = array();
    }
}

function getArticles() {
    return [
        [
            'name' => 'Nantes',
            'id' => '1',
            'price' => 99.99,
            'description' => 'Maillot domicile 2022',
            'details' => 'Le FC Nantes et l’équipementier italien Macron sont heureux de vous présenter le maillot domicile de la saison 2022-23, 
            dont les couleurs emblématiques du Club sont une nouvelle fois mises à l’honneur.',
            'picture' => 'nantes.jpg',
        ],
        [
            'name' => 'Lyon',
            'id' => '2',
            'price' => 39.99,
            'description' => 'Maillot domicile 1969',
            'details' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. 
            Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
            'picture' => 'lyon.jpg',
        ],
        [
            'name' => 'Marseille',
            'id' => '3',
            'price' => 119.99,
            'description' => 'Maillot domicile 2022',
            'details' => 'Le nouveau maillot domicile de l\'OM a été dévoilé par Puma avec une approche rétro et un hommage à l’histoire.
            Ce maillot remet au cœur du jeu les aspérités et les caractéristiques de notre ville, Marseille',
            'picture' => 'marseille.jpg',
        ],
        [
            'name' => 'Lens',
            'id' => '4',
            'price' => 119.99,
            'description' => 'Maillot domicile 2022',
            'details' => 'Maillot Domicile Adulte 2022-2023. Manches courtes avec tous flocages sponsors + badge Ligue 1. Disponible de la taille S jusque 3XL.',
            'picture' => 'lens.jpg',
        ],
        ];
}

function showArticles()
{
    // je récupère mon tableau de 3 articles
    $articles = getArticles();

    // je boucle dessus pour affcher une card par article
    foreach ($articles as $article) {
        echo "<div class=\"card col-md-5 col-lg-3 p-3 m-3\" style=\"width: 18rem;\">
                <img class=\"card-img-top\" src=\"images/" . $article['picture'] . "\" alt=\"Card image cap\">
                <div class=\"card-body\">
                    <h5 class=\"card-title font-weight-bold text-center\">${article['name']}</h5>
                    <p class=\"card-text font-italic text-center\">" . $article['description'] . "</p>
                    <p class=\"card-text font-weight-light text-center\">" . $article['price'] . " €</p>
                    <form action=\"product.php\" method=\"post\">
                        <input type=\"hidden\" name=\"idArticle\" value=\"" . $article['id'] . "\">
                        <input class=\"btn btn-light text-center\" type=\"submit\" value=\"Détails produit\">
                    </form>
                    <form action=\"panier.php\" method=\"post\">
                        <input type=\"hidden\" name=\"chosenArticle\" value=\"" . $article['id'] . "\">
                        <input class=\"btn btn-dark mt-2\" type=\"submit\" value=\"Ajouter au panier\">
                    </form>
                </div>
            </div>";
    }
}

function getArticleFromId($id)
{
    foreach (getArticles() as $article) {
        if ($article['id'] == $id) {
            return $article;
        }
    }
}

function ajoutArticle($articleAjout) {
    // on  vérifie si l'article n'est pas déjà présent
    foreach ($_SESSION["panier"] as $article) {
        if ($article["id"] == $articleAjout["id"]) {
            echo "<script>alert('Article déjà présent dans le panier')</script>";
            return;
        }
    }
    $articleAjout["quantite"] = 1;
    array_push($_SESSION["panier"], $articleAjout);
} 

function afficherPanier() {
    foreach ($_SESSION['panier'] as $article) {
        echo"
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-2\">
                <img class=\"mx-auto d-block w-50 img-thumbnail\" src=\"images/" . $article['picture'] . "\" alt=\"Card image cap\">
                </div>
                <div class=\"col-md-3 d-flex align-items-center\">
                    <h4 class=\"text-center name\">${article['name']}</h4>        
                </div>
                <div class=\"col-md-4 d-flex align-items-center\">
                    <form action=\"panier.php\" method=\"post\">
                    <input type=\"hidden\" name=\"modifQuantite\" value=\"" . $article['id'] . "\">
                    <input type=\"number\" name=\"quantite\" value=\"" . $article['quantite'] . "\">
                    <input class=\"btn btn-dark mt-2\" type=\"submit\" value=\"Modifier quantité\">
                    </form>
                </div>
                <div class=\"col-md-2 d-flex align-items-center\">
                    <h4 class=\"text-center prix\">${article['price']}</h4>
                </div>
                <div class=\"col-md-2 d-flex align-items-center\">
                <form action=\"panier.php\" method=\"post\">
                        <input type=\"hidden\" name=\"suppIdArticle\" value=\"" . $article['id'] . "\">
                        <input class=\"btn btn-dark mt-2\" type=\"submit\" value=\"Vider !\">
                    </form></div>
            </div>
        </div>";
    }
}


function suppressionArticle(){
    // éléments à préciser dans la boucle for
    // 1) $i = 0 => définition de l'index 
    // 2) condition de maintien de la boucle : évaluée avant de lancer chaque boucle
    // si elle est vraie => on lance la boucle
    // 3) évolution de $i après chaque boucle => $i augmente de 1

    for ($i=0; $i < count($_SESSION['panier']); $i++) {
        if ($_SESSION['panier'][$i]['id'] == $_POST["suppIdArticle"]){
            array_splice($_SESSION['panier'], $i, 1);
            echo "<script>alert('Suppression réussie')</script>";
            return;
        }
    }

}
// $_SESSION['panier'][0]
// [
//     'name' => 'Lyon',
//     'id' => '2',
//     'price' => '39,99',
//     'description' => 'Maillot domicile 1969',
//     'details' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. 
//     Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
//     'picture' => 'lyon.jpg',
//     'quantite' => 1
// ],

function modifQuantite() {
    for ($i=0; $i < count($_SESSION['panier']); $i++) {
        if ($_SESSION['panier'][$i]['id'] == $_POST["modifQuantite"]){
            $_SESSION['panier'][$i]['quantite'] = $_POST['quantite'];
            echo "<script>alert('Modification réussie')</script>";
            return;
        }
    }
}

function totalArticles() {
    $total = 0;
    foreach ($_SESSION['panier'] as $article) {
        $total = $total + ($article['price'] * $article['quantite']);
    }
    return $total;
}

function livraison() {
    $total = 0;
    foreach ($_SESSION['panier'] as $article) {
        $total = $total + ($article['quantite'] * 5);
    }
    return $total;
}

function viderPanier() {
    $_SESSION["panier"] = array();
}
?>