<h1>Liste des mentions marginale de l'acte de deces n°
    <?php echo $sf_request->getParameter("deces_id") ?>
</h1>

<table class="tableau">
    <div class="bouton">
        <a href="<?php echo url_for('mention_marginaledeces/new?deces_id='.$sf_request->getParameter('deces_id')) ?>">Ajouter une mention</a>
        <a href="<?php echo url_for('deces/show?id='.$sf_request->getParameter("deces_id")) ?>"> Retour </a>
    </div>
  <thead>
    <tr>
      <th></th>
      <th>Mention</th>
      <th>Date ajout</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $mention_marginale_deces): ?>
    <tr>
      <td><form action ="<?php echo  url_for('mention_marginaledeces/show?id='.$mention_marginale_deces->getId())?>"><input type="submit" value="Afficher" /></form> </td>
      <td><?php echo $mention_marginale_deces->getMention() ?></td>
      <td><?php echo $mention_marginale_deces->getDateAjout() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>

  <?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <?php include_partial('pagination', array('pager' => $pager)) ?>
    </div>
    <?php endif ?>
</table>
