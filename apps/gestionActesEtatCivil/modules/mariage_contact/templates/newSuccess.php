<h1>Ajout <?php echo $contact ?> : acte de mariage n°
    <?php echo $sf_request->getParameter("mariage_id")?>
</h1>

<?php include_partial('form', array('form' => $form)) ?>
