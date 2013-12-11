<h1>Mentions marginales de l'acte de Mariage n° <?php echo $sf_request->getParameter("mariage_id") ?></h1>

<table class="tableau">
    <div class="bouton">
        <a href="<?php echo url_for('mention_marginalemariage/new?mariage_id='.$sf_request->getParameter('mariage_id')) ?>">Ajouter une mention</a>
        <a href="<?php echo url_for('mariage/show?id='.$sf_request->getParameter("mariage_id")) ?>"> Retour </a>
    </div>
  <thead>
    <tr>
      <th></th>
      <th>Mariage</th>
      <!-- <th>Mention</th> -->
      <th>Date ajout</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $mention_marginale_mariage): ?>
    <tr>
      <td> <form action ="<?php echo  url_for('mention_marginalemariage/show?id='.$mention_marginale_mariage->getId())?>"><input type="submit" value="Afficher" /></form>  </td>
      <td><?php echo $mention_marginale_mariage->getMariageId() ?></td>
<!--      <td><?php echo $mention_marginale_mariage->getMention() ?></td>-->
      <td><?php echo $mention_marginale_mariage->getDateAjout() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>

  <?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <?php include_partial('pagination', array('pager' => $pager)) ?>
    </div>
  <?php endif ?>

</table>
