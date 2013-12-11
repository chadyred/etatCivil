<table class="tableau">
  <thead>
    <tr>
      <th></th>
      <th>Numero acte</th>
      <th>Numero ordre</th>
      <th>Date acte</th>
      <th>Type acte</th>
      <th>Nom defunt</th>
      <th>Prenom defunt</th>
      <th>Date deces</th>
      <th>Nom declarant</th>
      <th>Prenom declarant</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($deces as $deces): ?>
    <tr>
      <td><form action ="<?php echo  url_for('deces/show?id='.$deces->getId())?>"><input type="submit" value="Afficher" /></form>  </td>
      <td><?php echo $deces->getNumeroActe() ?></td>
      <td><?php echo $deces->getNumeroOrdre() ?></td>
      <td><?php echo $deces->getDateActe() ?></td>
      <td><?php echo $deces->getTypeActe() ?></td>
      <td><?php echo $deces->getNomDefunt() ?></td>
      <td><?php echo $deces->getPrenomDefunt() ?></td>
      <td><?php echo $deces->getDateDeces() ?></td>
      <td><?php echo $deces->getNomDeclarant() ?></td>
      <td><?php echo $deces->getPrenomDeclarant() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>