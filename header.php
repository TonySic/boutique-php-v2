    <header>
        <nav class="navbar navbar-expand-lg bg-light">

            <div class="container">
                <a class="navbar-brand" href="./index.php"><i class="fa-sharp fa-solid fa-futbol"></i> La Footixerie</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav text-dark">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./gammes.php">Gammes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./panier.php"><i class="fa-solid fa-cart-shopping"></i></a>
                        </li>
                        <?php if (isset($_SESSION['id'])) { ?>
                            <li class="nav-item text-align-right">
                                <a class="nav-link active" aria-current="page" href="./mon-compte.php">Mon compte</a>
                            </li>
                            <form action="./index.php" method="POST">
                                <button type="submit" name="deconnexion"><i class="fa-solid fa-door-open"></i></button>
                            </form>
                        <?php } else { ?>
                            <li class="nav-item text-align-right">
                                <a class="nav-link active" aria-current="page" href="./inscription.php">Connexion/Inscription</a>
                            </li>
                        <?php }



                        ?>



                    </ul>
                </div>
                <?php if (isset($_SESSION['id'])) {
                    echo "<p>Bonjour " . $_SESSION['prenom'] . "</p>";
                }
                ?>
            </div>
        </nav>
        <img src="./images/terrain-foot.jpg" alt="Terrain de foot" id="foot">
    </header>