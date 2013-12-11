<h1>Mention marginale du <?php echo $mention_marginale_naissance->getDateAjout()  ?>
        : acte n° <?php echo $sf_request->getParameter('id') ?></h1>

<table class="tableau">

    <div class="bouton">
      <a href="<?php echo url_for('mention_marginalenaissance_edit', $mention_marginale_naissance ) ?>">Editer Mention</a>
      <br />
      <a href="<?php echo url_for('DetailActeNaissance', array('id' => $mention_marginale_naissance->getNaissanceId())) ?>">Retour </a>
      <a href="<?php echo url_for('Show_MentionsActeNaissance', array('id' => $mention_marginale_naissance->getNaissanceId())) ?>">Retour liste</a>
    </div>

  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $mention_marginale_naissance->getId() ?></td>
    </tr>
    <tr>
      <th>Naissance:</th>
      <td><?php echo $mention_marginale_naissance->getNaissanceId() ?></td>
    </tr>
    <tr>
      <th>Mention:</th>
      <td><?php echo $mention_marginale_naissance->getMention() ?></td>
    </tr>
    <tr>
      <th>Date ajout:</th>
      <td><?php echo $mention_marginale_naissance->getDateAjout() ?></td>
    </tr>
  </tbody>
</table>
