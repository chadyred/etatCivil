<h1>Conjoints de l'acte de mariage n°
    <?php echo $sf_request->getParameter("mariage_id") ?>
</h1>


<table class="tableau">
    
    <div class="bouton">
        <!-- Bouton permettant le retour au mariage associé -->
        <a href="<?php echo url_for('mariage/show?id='.$mariage_acteurs->getFirst()->getMariageId())?>"> Retour </a>

    </div>
  <thead>
    <tr>
        <th></th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Sexe</th>
      <th>Type acteur</th>
      <th>Domicile</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($mariage_acteurs as $mariage_acteur): ?>
    <tr>
      <td><form action ="<?php echo  url_for('mariage_acteur/show?id='.$mariage_acteur->getId())?>"><input type="submit" value="Afficher" /></form></td>
      <td><?php echo $mariage_acteur->getNom() ?></td>
      <td><?php echo $mariage_acteur->getPrenom() ?></td>
      <td><?php echo $mariage_acteur->getSexe() ?></td>
      <td><?php echo $mariage_acteur->getTypeActeur() ?></td>
      <td><?php echo $mariage_acteur->getDomicile() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
