<h1>liste des <?php echo $typeContact ?> : acte de mariage n° <?php echo $sf_request->getParameter("mariage_id") ?></h1>

<table class="tableau">

  <div class="bouton">
       <a href="<?php echo url_for('mariage/show?id='.$sf_request->getParameter("mariage_id")) ?>">Retour liste</a>
  </div>

  <thead>
    <tr>
      <th></th>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Type contact</th>
      <th>En relation a</th>
      <th>Domicile</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($mariage_contacts as $mariage_contact): ?>
    <tr>
      <td><form action ="<?php echo  url_for('mariage_contact/show?id='.$mariage_contact->getId())?>"><input type="submit" value="Afficher" /></form></td>
      <td><?php echo $mariage_contact->getNom() ?></td>
      <td><?php echo $mariage_contact->getPrenom() ?></td>
      <td><?php echo $mariage_contact->getTypeContact() ?></td>
      <td><?php echo $mariage_contact->getEnRelationA() ?></td>
      <td><?php echo $mariage_contact->getDomicile() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
