<?php use_helper('Date'); ?>

<?php $sf_user->setCulture('fr_FR');?>

<!-- Permet d'afficher dans le titre l'cteur que l'on selectionne -->
<?php
    $titreTypeActeur = "NONE";

    if($naissance_acteur->getTypeActeur()=="autre préciser...")
    {
        $titreTypeActeur = $naissance_acteur->getTypeAutres();
    } else {
        $titreTypeActeur = $naissance_acteur->getTypeActeur();
    }

?>

<h1> Détails <?php echo $titreTypeActeur ?>
    : acte den° <?php echo $naissance_acteur->getNaissanceId() ?></h1>
<table class="tableau">
    
  <div class="bouton">
      <a href="<?php echo url_for('naissance_acteur_edit', array('id' => $naissance_acteur->getId())) ?>">Editer Acteur</a>

      <a href="<?php echo url_for('Show_naissance_parents', array('id' => $naissance_acteur->getNaissance_id())) ?>">Retour liste</a>
  </div>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $naissance_acteur->getId() ?></td>
    </tr>
    <tr>
      <th>Naissance:</th>
      <td><?php echo $naissance_acteur->getNaissanceId() ?></td>
    </tr>
    <tr>
      <th>Nom:</th>
      <td><?php echo $naissance_acteur->getNom() ?></td>
    </tr>
    <tr>
      <th>Prénom:</th>
      <td><?php echo $naissance_acteur->getPrenom() ?></td>
    </tr>
    <tr>
      <th>Age:</th>
      <td><?php echo $naissance_acteur->getAge() ?></td>
    </tr>
    <tr>
      <th>Date naissance:</th>
      <td><?php echo format_date($naissance_acteur->getDateNaissance(), "dd/MM/yyyy") ?></td>
    </tr>
    <tr>
      <th>Lieu naissance:</th>
      <td><?php echo Ville_france::getVilleDepartement($naissance_acteur->getLieuNaissance()) ?></td>
    </tr>
    <tr>
      <th>Profession:</th>
      <td><?php echo $naissance_acteur->getProfession() ?></td>
    </tr>
    <tr>
      <th>Domicile:</th>
      <td><?php echo $naissance_acteur->getDomicile() ?></td>
    </tr>
    <tr>
      <th>Est déclarant:</th>
      <td><?php echo $naissance_acteur->getEstDeclarant() ?></td>
    </tr>
    <tr>
      <th>Type acteur:</th>
      <td><?php echo $naissance_acteur->getTypeActeur() ?></td>
    </tr>
    <tr>
      <th>Type autres:</th>
      <td><?php echo $naissance_acteur->getTypeAutres() ?></td>
    </tr>
  </tbody>
</table>
