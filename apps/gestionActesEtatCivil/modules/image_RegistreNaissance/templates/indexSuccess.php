<h1>Liste des Scans du registre : acte n°
            <?php echo $sf_request->getParameter('id') ?></h1>

<table class="tableau">
    
  <div class="bouton">
    <a href="<?php echo url_for('DetailActeNaissance', array('id' => $sf_request->getParameter('id')))?>"> Retour </a>
    <a href="<?php echo url_for('image_RegistreNaissance_new', array('id' => $sf_request->getParameter('id')))?>"> Ajouter un scan </a>
  </div>
  <thead>
    <tr>
      <th></th>
      <th>Naissance</th>
      <th>Nom du Scan</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $image_registre_naissance): ?>
    <tr>
      <td><form action ="<?php echo url_for('image_RegistreNaissance_download', array('id' => $image_registre_naissance->getId(),
                                                                                      'scan' => $image_registre_naissance->getNomImage()))?>">
      <input type="submit" value="Telecharger" /></form></td>
      <td><?php echo $image_registre_naissance->getNaissanceId() ?></td>
      <td><?php echo $image_registre_naissance->getNomImage() ?></td>
      <td><?php echo link_to('Supprimer', 'image_RegistreNaissance/delete?id='.$image_registre_naissance->getId()."&scan=".$image_registre_naissance->getNomImage(), array('method' => 'delete', 'confirm' => 'Êtes vous sure de vouloir supprimer ce scan ?')) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>

  <?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <?php include_partial('pagination', array('pager' => $pager)) ?>
    </div>
  <?php endif ?>

</table>
