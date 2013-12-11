<h1>mentions marginales : acte de mariage n°
        <?php echo $sf_request->getParameter('id') ?></h1>

<table class="tableau">
    <div class="bouton">
        <a href="<?php echo url_for('mention_marginalenaissance_new', array('id' => $sf_request->getParameter('id'))) ?>">Ajouter une mention</a>
        <br />
        <a href="<?php echo url_for('DetailActeNaissance', $naissanceMM ) ?>">Retour</a>
    </div>
  <thead>
    <tr>
      <th></th>
      <th>Naissance</th>
      <th>Mention</th>
      <th>Date ajout</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $mention_marginale_naissance): ?>
    <tr>
      <td><form action ="<?php echo  url_for('mention_marginalenaissance/show?id='.$mention_marginale_naissance->getId())?>"><input type="submit" value="Afficher" /></form></td>
      <td><?php echo $mention_marginale_naissance->getNaissanceId() ?></td>
      <td><?php echo $mention_marginale_naissance->getMention() ?></td>
      <td><?php echo $mention_marginale_naissance->getDateAjout() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>

  <?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <?php include_partial('pagination', array('pager' => $pager)) ?>
    </div>
  <?php endif ?>

</table>
