<?php
    $titreTypeActeur;

    if (!$form->getDefault('typeActeur') == "autre préciser..." )
    {
        $titreTypeActeur = $form->getDefault('typeActeur');
    } else {
        $titreTypeActeur = "déclarant";
    }
?>

<h1>Ajout <?php echo $titreTypeActeur ?>
    : acte n°<?php echo $sf_request->getParameter('id') ?> </h1>

<?php include_partial('form', array('form' => $form)) ?>
