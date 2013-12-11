<!-- Permet d'afficher dans le titre l'cteur que l'on selectionne -->
<?php
    $titreTypeActeur;

    if($form->getDefault("typeActeur")=="autre préciser...")
    {
        $titreTypeActeur = $form->getDefault("typeAutres");
    } else {
        $titreTypeActeur = $form->getDefault("typeActeur");
    }

?>

<h1> Edition <?php echo $titreTypeActeur ?>
    : acte n° <?php echo $form->getDefault("id") ?></h1>

<?php include_partial('form', array('form' => $form)) ?>
