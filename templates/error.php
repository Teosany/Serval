<?php $title = "DOOM"; ?>

<?php ob_start(); ?>
<h1></h1>
<p>Une erreur est survenue : <?= $errorMessage ?></p>
<?php ob_get_clean(); ?>