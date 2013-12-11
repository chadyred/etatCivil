<?php use_helper('Date'); ?>

<?php $sf_user->setCulture('fr_FR');?>

<h1> Détails enfant :
    acte n° <?php echo $naissance_enfant->getNaissanceId() ?></h1>
<table class="tableau">
    
  <div class="bouton">
      <a href="<?php echo url_for('naissance_enfant_edit', array('id' => $naissance_enfant->getId())) ?>">Editer</a>
      <br />
      <a href="<?php echo url_for('naissance/show?id='.$sf_request->getParameter('id')) ?>">Retour</a>
  </div>
  <tbody>
    <tr>
      <th>Naissance:</th>
      <td><?php echo $naissance_enfant->getNaissanceId() ?></td>
    </tr>
    <tr>
      <th>Nom:</th>
      <td><?php echo $naissance_enfant->getNom() ?></td>
    </tr>
    <tr>
      <th>Prénom:</th>
      <td><?php echo $naissance_enfant->getPrenom() ?></td>
    </tr>
    <tr>
      <th>Sexe:</th>
      <td><?php echo $naissance_enfant->getSexe() ?></td>
    </tr>
    <tr>
      <th>Date naissance:</th>
      <td><?php echo format_date($naissance_enfant->getDateNaissance(), "dd/MM/yyyy") ?></td>
    </tr>
    <tr>
      <th>Heure naissance:</th>
      <td><?php echo $naissance_enfant->getHeureNaissance() ?></td>
    </tr>
    <tr>
      <th>Lieu naissance:</th>
      <td><?php echo Ville_france::getVilleDepartement($naissance_enfant->getLieuNaissance()) ?></td>
    </tr>
    <tr>
      <th>Date Mariage Parents :</th>
      <td><?php echo format_date($naissance_enfant->getDateMariageParents(), "dd/MM/yyyy") ?></td>
    </tr>
    <tr>
      <th>Domicile:</th>
      <td><?php echo $naissance_enfant->getDomicile() ?></td>
    </tr>
    <tr>
      <th>Lieu du mariage des parents:</th>
      <td><?php echo $naissance_enfant->getLieuMariageParents() ?></td>
    </tr>
  </tbody>
</table>
