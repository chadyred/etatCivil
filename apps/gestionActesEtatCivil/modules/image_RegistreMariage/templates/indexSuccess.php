<h1>Liste des Scans de l'acte de mariages <?php echo $sf_request->getParameter("mariage_id") ?></h1>

<table class="tableau">
    <div class="bouton">
        <a href="<?php echo url_for('image_RegistreMariage/new?id='.$sf_request->getParameter("mariage_id"))?>"> Ajouter un scan </a>
        <a href="<?php echo url_for('mariage/show?id='.$sf_request->getParameter("mariage_id"))?>"> Retour </a>
    </div>

  <thead>
    <tr>
      <th></th>
      <th>Mariage</th>
      <th>Nom image</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $image_registre_mariage): ?>
    <tr>
      <td><form action ="<?php echo url_for('image_RegistreMariage_download', array('id' => $image_registre_mariage->getId(),
                                                                                      'scan' => $image_registre_mariage->getNomImage()))?>">
      <input type="submit" value="Telecharger" /></form></td>
        <td><?php echo $image_registre_mariage->getMariageId() ?></td>
        <td><?php echo $image_registre_mariage->getNomImage() ?></td>
        <td><?php echo link_to('Supprimer', 'image_RegistreMariage/delete?id='.$image_registre_mariage->getId()."&nomScan=".$image_registre_mariage->getNomImage(), array('method' => 'delete', 'confirm' => 'Êtes vous sure de vouloir supprimer ce scan ?')) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>

  <?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <?php include_partial('pagination', array('pager' => $pager)) ?>
    </div>
  <?php endif ?>

</table>
