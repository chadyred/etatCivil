<h1>Détails mention marginale : acte de décès n°
    <?php echo $mention_marginale_deces->getDecesId() ?>
</h1>

<table class="tableau">

    <div class="bouton">
        <a href="<?php echo url_for('mention_marginaledeces/edit?id='.$mention_marginale_deces->getId()) ?>">Editer mention</a>
        <a href="<?php echo url_for('deces/show?id='.$mention_marginale_deces->getDeces_id()) ?>">Retour</a>
    </div>
    
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $mention_marginale_deces->getId() ?></td>
    </tr>
    <tr>
      <th>Deces:</th>
      <td><?php echo $mention_marginale_deces->getDecesId() ?></td>
    </tr>
    <tr>
      <th>Mention:</th>
      <td><?php echo $mention_marginale_deces->getMention() ?></td>
    </tr>
    <tr>
      <th>Date ajout:</th>
      <td><?php echo $mention_marginale_deces->getDateAjout() ?></td>
    </tr>
  </tbody>
</table>
