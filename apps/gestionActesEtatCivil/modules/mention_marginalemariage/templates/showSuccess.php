<h1>Détails mention marginale n°  <?php echo $mention_marginale_mariage->getId() ?>
    : acte  de mariage n° <?php echo $mention_marginale_mariage->getMariageId() ?></h1>

<table class="tableau">

    <div class="bouton">
      <a href="<?php echo url_for('mention_marginalemariage/edit?id='.$mention_marginale_mariage->getId()) ?>">Editer mention</a>
      <br />
      <a href="<?php echo url_for('mariage/show?id='.$mention_marginale_mariage->getMariage_id()) ?>">Retour liste</a>
    </div>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $mention_marginale_mariage->getId() ?></td>
    </tr>
    <tr>
      <th>Mariage:</th>
      <td><?php echo $mention_marginale_mariage->getMariageId() ?></td>
    </tr>
    <tr>
      <th>Mention:</th>
      <td><?php echo $mention_marginale_mariage->getMention() ?></td>
    </tr>
    <tr>
      <th>Date ajout:</th>
      <td><?php echo $mention_marginale_mariage->getDateAjout() ?></td>
    </tr>
  </tbody>
</table>

