<?php use_helper('Date'); ?>
<?php $sf_user->setCulture('fr_FR');?>

<h1>Résultats de la recherche sur les actes de naissance</h1>

<div class="bouton">
    <a href="<?php echo url_for('@naissance_search') ?>">Nouvelle Recherche</a>
    <a href="<?php echo url_for('naissance/index') ?>">Retour liste</a>
</div>

<table class="tableau">

    <tr>
        <td>Sélection</td>
        <td>Id de l'acte</td>
        <td>Numéro acte</td>
        <td>Date de l'acte</td>
        <td>Nom Prénom</td>
        <td>Date de naissance</td>
    </tr>
    <?php foreach ($pager->getResults() as $naissance){ ?>
        <tr>
            <td><form action ="<?php echo  url_for('naissance/show?id='.$naissance->getId())?>"><input type="submit" value="Afficher"/></form></td>
            <td><?php  echo $naissance->getId()?></td>
            <td><?php  echo $naissance->getNumeroActe() ?></td>
            <td><?php  echo format_date($naissance->getDateActe(), "dd/MM/yyyy")?></td>
            <td><?php if($naissance->getEnfant() != null) {
                     echo $naissance->getEnfant()->getNom()." ".$naissance->getEnfant()->getPrenom();
                } elseif ($naissance->PereIsPresent()) {    //Si il s'ajout d'une reconnaissance, on affiche le nom+prénom du père. Sinon, on affiche le nom et prénom de la mère
                    echo $naissance->getPere()->getNom()." ". $naissance->getPere()->getPrenom();
                } else {
                    echo $naissance->getMere()->getNom()." ". $naissance->getMere()->getPrenom();
                }
          ?></td>
            <td><?php if($naissance->getEnfant() != null) {
                echo format_date($naissance->getEnfant()->getDateNaissance(), "dd/MM/yyyy");
            } ?></td>
        </tr>
    <?php
    } ?>


<?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <?php include_partial('pagination', array('pager' => $pager)) ?>
    </div>
<?php endif ?>

</table>



