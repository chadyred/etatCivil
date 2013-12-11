<?php use_helper('Date'); ?>
<?php $sf_user->setCulture('fr_FR');?>

<h1>Résultats de la recherche sur les actes de mariage</h1>

<div class="bouton">
    <a href="<?php echo url_for('mariage/search') ?>">Nouvelle recherche</a>
    <a href="<?php echo url_for('mariage/index') ?>">Retour</a>
</div>


<table class="tableau">

    <tr>
        <td>Selection</td>
        <td>Id de l'acte</td>
        <td>Numéro acte</td>
        <td>Nom Conjoint 1</td>
        <td>Nom Conjoint 2</td>
        <td>Date de l'acte</td>
    </tr>
   
    <?php foreach ($pager->getResults() as $mariage){ ?>
        <tr>
            <td><form action ="<?php echo  url_for('mariage/show?id='.$mariage->getId())?>"><input type="submit" value="Afficher" /></form></td>
            <td><?php  echo $mariage->getId()?></td>
            <td><?php  echo $mariage->getNumeroActe() ?></td>
            <td><?php  echo $mariage->getconjoint1()->getNom()." ".$mariage->getconjoint1()->getPrenom() ?></td>
            <td><?php  echo $mariage->getConjoint2()->getNom()." ".$mariage->getConjoint2()->getPrenom() ?></td>
            <td><?php  echo format_date($mariage->getDateActe(), "dd/MM/yyyy")?></td>
        </tr>
    <?php
    } ?>


<?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <?php include_partial('pagination', array('pager' => $pager)) ?>
    </div>
<?php endif ?>

</table>



