<?php require_once('./requete_sql/config.php') ?>
<?php require_once('./requete_sql/fonctions_sql.php') ?>
<?php require_once('./template/_function_render.php') ?>


<?php require_once('./template/_header.php') ?>
<?php require_once('./template/_navbar.php') ?>

<h1>Top 3</h1>
<div class="d-flex flex-wrap justify-content-center">
    <?php get_top_3() ?>
</div>

<?php require_once('./template/_footer.php') ?>