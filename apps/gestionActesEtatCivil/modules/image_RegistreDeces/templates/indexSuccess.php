<h1>Liste des Scans de l'acte de décès n°
    <?php echo $sf_request->getParameter("deces_id")?>
</h1>

<table class="tableau">
    <div class="bouton">
        <a href="<?php echo url_for('image_RegistreDeces/new?deces_id='.$sf_request->getParameter("deces_id"))?>"> Ajouter un scan </a>
        <a href=" <?php echo url_for("deces/show?id=".$sf_request->getParameter("deces_id")) ?> ">Retour</a>
    </div>
    
  <thead>
    <tr>
      <th></th>
      <th>Deces</th>
      <th>Nom image</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $image_registre_deces): ?>
    <tr>
      <td><form action ="<?php echo url_for('image_RegistreDeces_download', array('id' => $image_registre_deces->getId(),
                                                                                      'scan' => $image_registre_deces->getNomImage()))?>">
          <input type="submit" value="Telecharger" /></form></td>
      <td><?php echo $image_registre_deces->getDecesId() ?></td>
      <td><?php echo $image_registre_deces->getNomImage() ?></td>
      <td><?php echo link_to('Supprimer', 'image_RegistreDeces/delete?id='.$image_registre_deces->getId()."&nomScan=".$image_registre_deces->getNomImage(), array('method' => 'delete', 'confirm' => 'Êtes vous sure de vouloir supprimer ce scan ?')) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>

  <?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <?php include_partial('pagination', array('pager' => $pager)) ?>
    </div>
    <?php endif ?>

</table>
