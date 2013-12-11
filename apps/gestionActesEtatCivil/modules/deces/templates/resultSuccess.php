<?php use_helper('Date'); ?>
<?php $sf_user->setCulture('fr_FR');?>

<h1>Résultats de la recherche sur les actes de décès</h1>

<div class="bouton">
    <a href="<?php echo url_for('deces/search') ?>">Nouvelle recherche</a>
    <a href="<?php echo url_for('deces/index') ?>">Retour</a>
</div>

<table class="tableau">

    <tr>
        <td>Sélection</td>
        <td>Id de l'acte</td>
        <td>Numéro acte</td>
        <td>Nom Défunt</td>
        <td>Prénom Défunt</td>
        <td>Date de l'acte</td>
    </tr>
    <?php foreach ($pager->getResults() as $deces){ ?>
        <tr>
            <td><form action ="<?php echo  url_for('deces/show?id='.$deces->getId())?>"><input type="submit" value="Afficher" /></form></td>
            <td><?php  echo $deces->getId()?></td>
            <td><?php  echo $deces->getNumeroActe() ?></td>
            <td><?php  echo $deces->getnomDefunt() ?></td>
            <td><?php  echo $deces->getPrenomDefunt() ?> </td>
            <td><?php  echo format_date($deces->getDateActe(), "dd/MM/yyyy")?></td>
        </tr>
    <?php
    } ?>


<?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <?php include_partial('pagination', array('pager' => $pager)) ?>
    </div>
<?php endif ?>

</table>



