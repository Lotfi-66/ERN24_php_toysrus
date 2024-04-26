<?php require_once('./requete_sql/config.php') ?>
<?php require_once('./requete_sql/fonctions_sql.php') ?>
<?php require_once('./template/_function_render.php') ?>


<?php require_once('./template/_header.php') ?>
<?php require_once('./template/_navbar.php') ?>


<!--on récupère l'id passé dans l'url-->
<?php $brand_id = intval($_GET['brand_id']); ?>

<h1>Jouet par marque</h1>
<div class="d-flex flex-wrap justify-content-center">
    <!--on appelle la fonction en lui transmettant l'id-->
<?php get_toy_by_brand($brand_id)?>
</div>
<?php require_once('./template/_footer.php') ?>