<h1>Enfant de l'acte de Naissance n°<?php echo $naissance_enfants->getFirst()->getNaissance()->getId() ?></h1>

<table class="tableau">

  <thead>
    <tr>
      <th>Id</th>
      <th>Naissance</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Sexe</th>
      <th>Date naissance</th>
      <th>Heure naissance</th>
      <th>Lieu naissance</th>
      <th>Parents mariés</th>
      <th>Date mariage parents</th>
      <th>Lieu mariage parents</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($naissance_enfants as $naissance_enfant): ?>
    <tr>
      <td><?php echo $naissance_enfant->getId() ?></td>
      <td><?php echo $naissance_enfant->getNaissanceId() ?></td>
      <td><?php echo $naissance_enfant->getNom() ?></td>
      <td><?php echo $naissance_enfant->getPrenom() ?></td>
      <td><?php echo $naissance_enfant->getSexe() ?></td>
      <td><?php echo $naissance_enfant->getDateNaissance() ?></td>
      <td><?php echo $naissance_enfant->getHeureNaissance() ?></td>
      <td><?php echo Ville_france::getVilleDepartement($naissance_enfant->getLieuNaissance()) ?></td>
      <td><?php echo $naissance_enfant->getParentsMaries() ?></td>
      <td><?php echo $naissance_enfant->getDateMariageParents() ?></td>
      <td><?php echo $naissance_enfant->getLieuMariageParents() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
  <div class="bouton">
      <a href="<?php echo url_for("naissance_enfant/edit?id=".$naissance_enfant->getId())?>" >Modifier enfant</a>
      <br />
      <a href="<?php echo url_for("naissance/show?id=".$sf_request->getParameter("id")) ?>">Retour</a>
  </div>
</table>
