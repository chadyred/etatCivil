<?php use_helper('Date'); ?>

<?php $sf_user->setCulture('fr_FR');?>

<h1>Liste des actes de naissance</h1>

<div class="bouton">
    <a href="<?php echo url_for('@NouvelActeNaissance') ?>">Nouvel Acte</a>
    <a href="<?php echo url_for('@naissance_search') ?>">Recherche</a>
    <br />
    <a href="<?php echo url_for('@Menu_selection') ?>">Retour Accueil</a>
</div>

<table class="tableau"> 
  <thead>
    <tr>
      <th></th>
      <th>Numéro acte</th>
      <th>Numéro ordre</th>
      <th>Type acte</th>
      <th>Date acte</th>
      <th>Nom prénom</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $naissance): ?>
    <tr>
      <td><form action ="<?php echo  url_for('DetailActeNaissance', $naissance)?>"><input type="submit" value="Afficher" /></form>  </td>
      <td><?php echo $naissance->getNumeroActe() ?></td>
      <td><?php echo $naissance->getNumeroOrdre() ?></td>
      <td><?php echo $naissance->getTypeActe() ?></td>
      <td><?php echo format_date($naissance->getDateActe(), "dd/MM/yyyy") ?></td>
      <td><?php if($naissance->getEnfant() != null) { 
                     echo $naissance->getEnfant()->getNom()." ".$naissance->getEnfant()->getPrenom();
                } elseif ($naissance->PereIsPresent()) {    //Si il s'ajout d'une reconnaissance, on affiche le nom+prénom du père. Sinon, on affiche le nom et prénom de la mère
                    echo $naissance->getPere()->getNom()." ". $naissance->getPere()->getPrenom();
                } else {
                    echo $naissance->getMere()->getNom()." ". $naissance->getMere()->getPrenom();
                }
          ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>

  <?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <?php include_partial('pagination', array('pager' => $pager)) ?>
    </div>
  <?php endif ?>

</table>
