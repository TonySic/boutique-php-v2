<?php

function creationPanier()
{
    if (!isset($_SESSION["panier"])) {
        $_SESSION["panier"] = array();
    }
}

function getConnection()
{
    // try : je tente une connexion
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=boutique_en_ligne;charset=utf8',
            'root',
            '',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC)
        );
        // si ça ne marche pas : je mets fin au code php en affichant l'erreur
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    return $db;
}

function getArticles()
{
    $db = getConnection();
    // je prépare une requête
    $query = $db->query('SELECT * FROM articles');
    // j'exécute ma requête
    return $query->fetchAll();
}


// select * from articles where id_gamme = :id_gamme
function getGammes()
{
    $db = getConnection();
    // je prépare une requête
    $query = $db->query('SELECT * FROM gammes');
    // j'exécute ma requête
    return $query->fetchAll();
}


function getArticlesByGammes($gamme_id)
{
    $db = getConnection();
    $query = $db->prepare('SELECT * FROM articles WHERE id_gamme = ?');
    $query->execute(array($gamme_id));
    return $query->fetchAll();
}


function showArticles($articles)
{
    // je boucle dessus pour affcher une card par article
    foreach ($articles as $article) {
        echo "<div class=\"card col-md-5 col-lg-3 p-3 m-3\" style=\"width: 18rem;\">
                <img class=\"card-img-top\" src=\"images/" . $article['image'] . "\" alt=\"Card image cap\">
                <div class=\"card-body\">
                    <h5 class=\"card-title font-weight-bold text-center\">${article['nom']}</h5>
                    <p class=\"card-text font-italic text-center\">" . $article['description'] . "</p>
                    <p class=\"card-text font-weight-light text-center\">" . $article['prix'] . " €</p>
                    <form action=\"product.php\" method=\"post\">
                        <input type=\"hidden\" name=\"idArticle\" value=\"" . $article['id'] . "\">
                        <input class=\"btn btn-secondary text-center mx-auto\" type=\"submit\" value=\"Détails produit\">
                    </form>
                    <form action=\"panier.php\" method=\"post\">
                        <input type=\"hidden\" name=\"chosenArticle\" value=\"" . $article['id'] . "\">
                        <input class=\"btn btn-dark mt-2 mx-auto\" type=\"submit\" value=\"Ajouter au panier\">
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

function ajoutArticle($articleAjout)
{
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

function afficherPanier()
{
    foreach ($_SESSION['panier'] as $article) {
        echo "
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-2\">
                <img class=\"mx-auto d-block w-50 img-thumbnail\" src=\"images/" . $article['image'] . "\" alt=\"Card image cap\">
                </div>
                <div class=\"col-md-3 d-flex align-items-center\">
                    <h5 class=\"text-center name\">${article['nom']}</h5>        
                </div>
                <div class=\"col-md-4 d-flex align-items-center\">
                    <form action=\"panier.php\" method=\"post\">
                    <input type=\"hidden\" name=\"modifQuantite\" value=\"" . $article['id'] . "\">
                    <input type=\"number\" name=\"quantite\" value=\"" . $article['quantite'] . "\">
                    <input class=\"btn btn-dark mt-2\" type=\"submit\" value=\"Modifier quantité\">
                    </form>
                </div>
                <div class=\"col-md-2 d-flex align-items-center\">
                    <h4 class=\"text-center prix\">${article['prix']}</h4>
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


function suppressionArticle()
{
    // éléments à préciser dans la boucle for
    // 1) $i = 0 => définition de l'index 
    // 2) condition de maintien de la boucle : évaluée avant de lancer chaque boucle
    // si elle est vraie => on lance la boucle
    // 3) évolution de $i après chaque boucle => $i augmente de 1

    for ($i = 0; $i < count($_SESSION['panier']); $i++) {
        if ($_SESSION['panier'][$i]['id'] == $_POST["suppIdArticle"]) {
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

function modifQuantite()
{
    for ($i = 0; $i < count($_SESSION['panier']); $i++) {
        if ($_SESSION['panier'][$i]['id'] == $_POST["modifQuantite"]) {
            $_SESSION['panier'][$i]['quantite'] = $_POST['quantite'];
            echo "<script>alert('Modification réussie')</script>";
            return;
        }
    }
}

function totalArticles()
{
    $total = 0;
    foreach ($_SESSION['panier'] as $article) {
        $total = $total + ($article['prix'] * $article['quantite']);
    }
    return $total;
}

function livraison()
{
    $total = 0;
    foreach ($_SESSION['panier'] as $article) {
        $total = $total + ($article['quantite'] * 5);
    }
    return $total;
}

function viderPanier()
{
    $_SESSION["panier"] = array();
}

function inscription()
{
    $db = getConnection(); //on se connecte à la BDD

    if (verifInputVide()) { //verif si les champs sont vides, sinon message d'erreur
        echo "<script>alert('Attention ! Un ou plusieurs champs vides')</script>";
    } else {

        if (verifLongueurInputs() == false) { //verif longueur des champs, sinon message d'erreur
            echo "<script>alert('Attention ! Longueur incorrect d'un ou plusieurs champs')</script>";
        } else {

            if (checkemail($_POST['email'])) { //vérif email valide et non utilisé
                echo "<script>alert('Attention ! Courriel déjà utilisé')</script>";
            } else {

                $query = $db->prepare('INSERT INTO clients (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)');
                $query->execute(array(
                    'nom' => $_POST['nom'],
                    'prenom' => $_POST['prenom'],
                    'email' => $_POST['email'],
                    'mot_de_passe' => password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT) // hâchage du mot de passe OBLIGATOIRE 
                ));

                $id = $db->lastInsertId();

                $query = $db->prepare('INSERT INTO adresses (id_client, adresse, code_postal, ville) VALUES (:id_client, :adresse, :code_postal, :ville)');
                $query->execute(array(
                    'id_client' => $id,
                    'adresse' => $_POST['adresse'],
                    'code_postal' => $_POST['code_postal'],
                    'ville' => $_POST['ville']
                ));

                echo "<script>alert('Inscription validée')</script>";
            }
        }
    }
}

function connexion()
{
    $db = getConnection();
    $query = $db->prepare('SELECT * FROM clients WHERE email=?');
    $query->execute(array($_POST['email']));
    $client = $query->fetch();
    // fonction connexion : vérifier si l'utilisateur existe en faisant un select + vérifier si son mdp est valide avec la fonction password_verify($mdpEnClair, $mdpHashéBdd)

    if ($client) {
        // on compare le mot de passe saisi avec le mot de passe de la base

        if (password_verify($_POST['mot_de_passe'], $client['mot_de_passe'])) {
            // si tout est bon : on stocke les infos dans la session
            $_SESSION['id'] = $client['id'];
            $_SESSION['nom'] = $client['nom'];
            $_SESSION['prenom'] = $client['prenom'];
            $_SESSION['email'] = $client['email'];

            $adresse = recupAdresse($client['id']);

            $_SESSION['adresse'] = $adresse['adresse'];
            $_SESSION['code_postal'] = $adresse['code_postal'];
            $_SESSION['ville'] = $adresse['ville'];

            echo "<script>alert('Vous êtes connecté')</script>";
        } else {
            echo "<script>alert('Mot de passe incorrect')</script>";
        }
    } else {
        echo "<script>alert('E-mail incorrect')</script>";
    }
    // si problèmes : afficher message d'erreur
}

function recupAdresse($id_client)
{
    $db = getConnection();
    $query = $db->prepare('SELECT * FROM adresses WHERE id_client=?');
    $query->execute(array($id_client));
    $adresse = $query->fetch();
    return $adresse;
}

function deconnexion()
{
    $_SESSION = array();
    echo "<script>alert('Déconnexion réussie !')</script>";
}

function modifInfo()
{
    $db = getConnection();
    $prenom =  strip_tags($_POST['prenom']);
    $nom = strip_tags($_POST['nom']);
    $email = strip_tags($_POST['email']);

    $query = $db->prepare("UPDATE clients SET nom = :nom, prenom = :prenom, email = :email WHERE id = :id");
    $query->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'id' => $_SESSION['id'],
    ));

    $_SESSION['prenom'] = $prenom;
    $_SESSION['nom'] = $nom;
    $_SESSION['email'] = $email;
    echo "<script>alert('Modification(s) effectuée(s) !')</script>";
}

function verifLongueurInputs()
{
    $inputsLenghtOk = true;

    if (strlen($_POST['prenom']) > 25 || strlen($_POST['prenom']) < 3) {
        $inputsLenghtOk = false;
    }

    if (strlen($_POST['nom']) > 25 || strlen($_POST['nom']) < 3) {
        $inputsLenghtOk = false;
    }

    if (strlen($_POST['email']) > 25 || strlen($_POST['email']) < 5) {
        $inputsLenghtOk = false;
    }

    if (strlen($_POST['adresse']) > 40 || strlen($_POST['adresse']) < 5) {
        $inputsLenghtOk = false;
    }

    if (strlen($_POST['code_postal']) !== 5) {
        $inputsLenghtOk = false;
    }

    if (strlen($_POST['ville']) > 25 || strlen($_POST['ville']) < 3) {
        $inputsLenghtOk = false;
    }

    return $inputsLenghtOk;
}

function verifInputVide()
{
    foreach ($_POST as $field) {
        if (empty($field)) {
            return true;
        }
    }
    return false;
}

function checkEmail($email) // vérif e-mail déjà utilisé
{
    $db = getConnection();

    $query = $db->prepare("SELECT * FROM clients WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch();

    if ($user) {
        return true;
    } else {
        return false;
    }
}

function checkPassword($password)
{
    // minimum 8 caractères et maximum 15, minimum 1 lettre, 1 chiffre et 1 caractère spécial
    $regex = "^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@$!%*?/&])(?=\S+$).{8,15}$^";
    return preg_match($regex, $password);
}

function modifAdresse()
{
    $db = getConnection();
    $adresse = strip_tags($_POST['adresse']);
    $ville = strip_tags($_POST['ville']);
    $code_postal = strip_tags($_POST['code_postal']);

    $query = $db->prepare("UPDATE adresses SET adresse = :adresse, ville = :ville, code_postal = :code_postal WHERE id_client = :id_client");
    $query->execute(array(
        'adresse' => $adresse,
        'ville' => $ville,
        'code_postal' => $code_postal,
        'id_client' => $_SESSION['id'],
    ));

    $_SESSION['adresse'] = $adresse;
    $_SESSION['ville'] = $ville;
    $_SESSION['code_postal'] = $code_postal;
    echo "<script>alert('Modification(s) effectuée(s) !')</script>";
}

function modifMDP()
{

    $db = getConnection();
    // On vérifie d'abord qu'il n'y a pas de champs vides. Si oui, message d'erreur et fin de la fonction.
    if (verifInputVide()) {
        echo "<script>alert('Merci de renseigner votre mot de passe.')</script>";
    } else {

        // On récupère le mdp actuel en BDD.
        $query = $db->prepare("SELECT * FROM clients WHERE id = ?");
        $query->execute(array($_SESSION['id']));
        $client = $query->fetch();

        // On vérifie le mdp actuel saisi par rapport à l'actuel en base.
        if (!password_verify($_POST['mot_de_passe'], $client['mot_de_passe'])) {
            echo "<script>alert('Mot de passe incorrect')</script>";
        } else {
            if (!checkPassword($_POST['new_mot_de_passe'])) {
                echo "<script>alert('Format du nouveau mot de passe incorrect')</script>";
            } else {
                $query = $db->prepare("UPDATE clients SET mot_de_passe = :new_mot_de_passe WHERE id = :id");
                $client = $query->execute(array(
                    'new_mot_de_passe' => password_hash($_POST['new_mot_de_passe'], PASSWORD_DEFAULT),
                    'id' => $_SESSION['id']
                ));
                echo "<script>alert('Modification réussie')</script>";
            }
        }
    }
}

function validation_commande() {
    $db = getConnection();
    $numero_commande = rand(1000000, 9999999);
    $sql1 = "INSERT INTO commandes (id_client , numero) VALUES (:id_client , :numero)";
    $prepare1 = $db->prepare($sql1);
    $execute1 = $prepare1->execute(
        array(
            ":id_client" => $_SESSION["id"],
            ":numero" => $numero_commande
        )
    );
    $sql2 = "INSERT INTO commande_articles (id_article , numero_commande , quantite) VALUES (:id_article , :numero_commande , :quantite)";
    $prepare2 = $db->prepare($sql2);
    for ($i = 0; $i < count($_SESSION["panier"]); $i++) {

        $execute2 = $prepare2->execute(
            array(
                ":id_article" => $_SESSION["panier"][$i]["id"],
                ":numero_commande" => $numero_commande,
                ":quantite" => $_SESSION["panier"][$i]["quantite"]
            )
        );
    }
    $sql3 = "UPDATE articles SET stock = :stock WHERE articles.id = " . $_SESSION["panier"][$i]["id"];
    $prepare3 = $db->prepare($sql3);
    for ($i = 0; $i < count($_SESSION["panier"]); $i++) {

        $execute3 = $prepare3->execute(
            array(
                ":stock" => $_SESSION["panier"][$i]["stock"] - $_SESSION["panier"][$i]["quantite"]

            )
        );
    }
}

function recupArticlesCommande($commandeId)
{
    $db = getConnection();
    $query = $db->prepare('SELECT * FROM commande_articles AS ca 
                            INNER JOIN articles AS a 
                            ON a.id = ca.id_article 
                            WHERE id_commande = ?');
    $query->execute([$commandeId]);
    return $query->fetchAll();
}
