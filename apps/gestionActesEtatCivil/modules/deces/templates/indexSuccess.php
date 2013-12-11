<?php use_helper('Date'); ?>

<?php $sf_user->setCulture('fr_FR');?>

<h1>Liste des actes de décès </h1>

<table class="tableau">
  <div class="bouton">
     <a href="<?php echo url_for('deces/new') ?>">Nouvel Acte</a>
     <a href="<?php echo url_for('deces/search') ?>">Recherche</a>
     <br />
     <a href="<?php echo url_for('@Menu_selection') ?>">Retour Accueil</a>
  </div>
  <thead>
    <tr>
        <th></th>
      <th>Numéro acte</th>
      <th>Numéro ordre</th>
      <th>Date acte</th>
      <th>Type acte</th>
      <th>Nom défunt</th>
      <th>Prénom défunt</th>
      <th>Date décès</th>
      <th>Nom déclarant</th>
      <th>Prénom déclarant</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $deces): ?>
    <tr>
      <td><form action ="<?php echo  url_for('deces/show?id='.$deces->getId())?>"><input type="submit" value="Afficher" /></form>  </td>
      <td><?php echo $deces->getNumeroActe() ?></td>
      <td><?php echo $deces->getNumeroOrdre() ?></td>
      <td><?php echo format_date($deces->getDateActe(), "dd/MM/yyyy") ?></td>
      <td><?php echo $deces->getTypeActe() ?></td>
      <td><?php echo $deces->getNomDefunt() ?></td>
      <td><?php echo $deces->getPrenomDefunt() ?></td>
      <td><?php echo format_date($deces->getDateDeces(), "dd/MM/yyyy") ?></td>
      <td><?php echo $deces->getNomDeclarant() ?></td>
      <td><?php echo $deces->getPrenomDeclarant() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>

  <?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <?php include_partial('pagination', array('pager' => $pager)) ?>
    </div>
  <?php endif ?>
  
</table>
