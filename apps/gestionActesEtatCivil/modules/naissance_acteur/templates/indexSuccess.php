<?php use_helper('Date'); ?>

<?php $sf_user->setCulture('fr_FR');?>

<h1>Liste des déclarants de l'acte naissance n°<?php echo $sf_request->getParameter("id") ?></h1>

<table class="tableau">
  <thead>
    <tr>
      <th></th>
      <th>Naissance</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Age</th>
      <th>Date naissance</th>
      <th>Lieu naissance</th>
      <th>Profession</th>
      <th>Domicile</th>
      <th>Est déclarant</th>
      <th>Type acteur</th>
      <th>Type autres</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($naissance_acteurs as $naissance_acteur): ?>
    <tr>
      <td><form action ="<?php echo  url_for('naissance_acteur_show', array('id' => $naissance_acteur->getId()))?>"><input type="submit" value="Afficher" /></form></td>
      <td><?php echo $naissance_acteur->getNaissanceId() ?></td>
      <td><?php echo $naissance_acteur->getNom() ?></td>
      <td><?php echo $naissance_acteur->getPrenom() ?></td>
      <td><?php echo $naissance_acteur->getAge() ?></td>
      <td><?php echo format_date($naissance_acteur->getDateNaissance(), "dd/MM/yyyy") ?></td>
      <td><?php echo Ville_france::getVilleDepartement($naissance_acteur->getLieuNaissance()) ?></td>
      <td><?php echo $naissance_acteur->getProfession() ?></td>
      <td><?php echo $naissance_acteur->getDomicile() ?></td>
      <td><?php echo $naissance_acteur->getEstDeclarant() ?></td>
      <td><?php echo $naissance_acteur->getTypeActeur() ?></td>
      <td><?php echo $naissance_acteur->getTypeAutres() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
    <div class="bouton">
      <a href="<?php echo url_for("naissance_acteur/new?id=".$sf_request->getParameter("id")) ?>">Ajouter un Déclarant</a>
      &nbsp;
      <a href="<?php echo url_for("naissance/show?id=".$sf_request->getParameter("id")) ?>">Retour</a>
    </div>
</table>
