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
            
        <?php foreach ($gammes as $gamme) {
            echo "<h2>" . $gamme['nom'] . "</h2>";
            $articles = getArticlesByGammes($gamme['id']);
            showArticles($articles);
        } 
                
        ?>
        </div>
    </div>
</body>

<?php
    include './footer.php';
?>

</html>
