<?php use_helper('Date'); ?>

<?php $sf_user->setCulture('fr_FR');?>

<h1>Détail acte de décès n°
    <?php echo $deces->getId()?>
</h1>

<table class="tableau">

    <div class="bouton">
      <a href="<?php echo url_for('deces/edit?id='.$deces->getId()) ?>">Editer Acte</a>
      <a href="<?php echo url_for('mention_marginaledeces/ShowByDeces?deces_id='.$deces->getId()) ?>">Mention marginale</a>
      <a href="<?php echo url_for('image_RegistreDeces/showByDeces?deces_id='.$deces->getId()) ?>">Scan(s) registre</a>
      <?php echo link_to('Documents', 'deces/popUpDocuments/?id='.$deces->getId(), array(
                                    'popup' => array('Documents', 'width=900,height=900,left=320,top=0') )) ?>
      <br />
      <a href="<?php echo url_for('deces/index') ?>">Retour liste</a>
   </div>

  <tbody>
    <tr>
      <th>Id :</th>
      <td><?php echo $deces->getId() ?></td>
    </tr>
    <tr>
      <th>Numero acte :</th>
      <td><?php echo $deces->getNumeroActe() ?></td>
    </tr>
    <tr>
      <th>Numero ordre :</th>
      <td><?php echo $deces->getNumeroOrdre() ?></td>
    </tr>
    <tr>
      <th>Date acte :</th>
      <td><?php echo format_date($deces->getDateActe(), "dd/MM/yyyy") ?></td>
    </tr>
    <tr>
      <th>Heure acte :</th>
      <td><?php echo $deces->getHeureActe() ?></td>
    </tr>
    <tr>
      <th>Type acte :</th>
      <td><?php echo $deces->getTypeActe() ?></td>
    </tr>
    <tr>
      <th>Nom défunt :</th>
      <td><?php echo $deces->getNomDefunt() ?></td>
    </tr>
    <tr>
      <th>Prénom défunt :</th>
      <td><?php echo $deces->getPrenomDefunt() ?></td>
    </tr>
    <tr>
      <th>Date décès :</th>
      <td><?php echo format_date($deces->getDateDeces(), "dd/MM/yyyy") ?></td>
    </tr>
    <tr>
      <th>Heure décès :</th>
      <td><?php echo $deces->getHeureDeces() ?></td>
    </tr>
    <tr>
      <th>Date approximative :</th>
      <td><?php echo $deces->getDateApproximative() ?></td>
    </tr>
    <tr>
      <th>Lieu décès :</th>
      <td><?php echo Ville_france::getVilleDepartement($deces->getLieuDeces()) ?></td>
    </tr>
    <tr>
      <th>En son domicile :</th>
      <td><?php echo $deces->getensondomicile()==0 ? "non" : "oui" ?></td>
    </tr>
    <tr>
      <th>Profession défunt :</th>
      <td><?php echo $deces->getProfessionDefunt() ?></td>
    </tr>
    <tr>
      <th>Domicile défunt :</th>
      <td><?php echo $deces->getDomicileDefunt() ?></td>
    </tr>
    <tr>
      <th>Date naissance défunt :</th>
      <td><?php echo format_date($deces->getDateNaissanceDefunt(), "dd/MM/yyyy") ?></td>
    </tr>
    <tr>
      <th>Lieu naissance défunt :</th>
      <td><?php echo Ville_france::getVilleDepartement($deces->getLieuNaissanceDefunt()) ?></td>
    </tr>
    <tr>
      <th>Nom prénom père défunt :</th>
      <td><?php echo $deces->getPrenomPereDefunt()." ".$deces->getNomPereDefunt() ?></td>
    </tr>
    <tr>
      <th>Nom prénom mère défunt :</th>
      <td><?php echo $deces->getPrenomMereDefunt()." ".$deces->getNomMereDefunt() ?></td>
    </tr>
    <tr>
      <th>Statut matrimonial :</th>
      <td><?php echo $deces->getStatutMatrimoniale() ?></td>
    </tr>
    <tr>
      <th>Nom déclarant :</th>
      <td><?php echo $deces->getNomDeclarant() ?></td>
    </tr>
    <tr>
      <th>Prénom déclarant :</th>
      <td><?php echo $deces->getPrenomDeclarant() ?></td>
    </tr>
    <tr>
      <th>Age déclarant :</th>
      <td><?php echo $deces->getAgeDeclarant() ?></td>
    </tr>
    <tr>
      <th>Profession déclarant :</th>
      <td><?php echo $deces->getProfessionDeclarant() ?></td>
    </tr>
    <tr>
      <th>Adresse déclarant :</th>
      <td><?php echo $deces->getAdresseDeclarant() ?></td>
    </tr>
  </tbody>
</table>
