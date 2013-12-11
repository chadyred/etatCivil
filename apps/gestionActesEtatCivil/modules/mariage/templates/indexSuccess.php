<?php use_helper('Date'); ?>

<?php $sf_user->setCulture('fr_FR');?>

<h1>Liste des actes de Mariage</h1>

<table class="tableau">
  <div class="bouton">
     <a href="<?php echo url_for('mariage/new') ?>">Nouvel Acte</a>
     <a href="<?php echo url_for('mariage/search') ?>">Recherche</a>
     <br />
     <a href="<?php echo url_for('@Menu_selection') ?>">Retour Accueil</a>
  </div>
  <thead>
    <tr>
      <th></th>
      <th>Numéro acte</th>
      <th>Numéro ordre</th>
      <th>Date Mariage</th>
      <th>Nom conjoint 1</th>
      <th>Nom conjoint 2</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $mariage): ?>
    <tr>
      <td><form action ="<?php echo  url_for('mariage/show?id='.$mariage->getId())?>"><input type="submit" value="Afficher" /></form>  </td>
      <td><?php echo $mariage->getNumeroActe() ?></td>
      <td><?php echo $mariage->getNumeroOrdre() ?></td>
      <td><?php echo format_date( $mariage->getDateMariage() , "dd/MM/yyyy") ?></td>
      <td><?php if($mariage->getConjoint1() != null) { echo $mariage->getConjoint1()->getNom()." ".$mariage->getConjoint1()->getPrenom(); } ?></td>
      <td><?php if($mariage->getConjoint2() != null) { echo $mariage->getConjoint2()->getNom()." ".$mariage->getConjoint2()->getPrenom(); } ?></td>
    </tr>
    <?php endforeach; ?>

  </tbody>

  <?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <?php include_partial('pagination', array('pager' => $pager)) ?>
    </div>
  <?php endif ?>

</table>
