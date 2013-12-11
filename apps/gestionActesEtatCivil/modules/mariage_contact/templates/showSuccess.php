<h1>Détails <?php echo $mariage_contact->getTypeContact() ?> : acte de mariage n°
    <?php echo $mariage_contact->getMariageId()?>
</h1>

<table class="tableau">

  <div class="bouton">
      <a href="<?php echo url_for('mariage_contact/edit?id='.$mariage_contact->getId()) ?>">Editer Contact</a>
      
      <?php //si il s'agit d'un témoin il faut revenir à la liste des témoins, sinon il faut revenir à la liste des parents
      ($mariage_contact->getTypeContact()=="témoin")? $typeC="témoin" : $typeC="père/mère" ?>
      
      <a href="<?php if ($typeC=="témoin"){
          echo url_for('mariage_contact/ShowTemoinsByMariage?mariage_id='.$mariage_contact->getMariage_id());
      }else{
          echo url_for('mariage_contact/ShowParentsByMariage?mariage_id='.$mariage_contact->getMariage_id());
      }?>">Retour liste</a>
  </div>
    
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $mariage_contact->getId() ?></td>
    </tr>
    <tr>
      <th>Mariage:</th>
      <td><?php echo $mariage_contact->getMariageId() ?></td>
    </tr>
    <tr>
      <th>Nom:</th>
      <td><?php echo $mariage_contact->getNom() ?></td>
    </tr>
    <tr>
      <th>Prenom:</th>
      <td><?php echo $mariage_contact->getPrenom() ?></td>
    </tr>
    <tr>
      <th>Type contact:</th>
      <td><?php echo $mariage_contact->getTypeContact() ?></td>
    </tr>
    <tr>
      <th>Age:</th>
      <td><?php echo $mariage_contact->getAge() ?></td>
    </tr>
    <tr>
      <th>Domicile:</th>
      <td><?php echo $mariage_contact->getDomicile() ?></td>
    </tr>
    <tr>
      <th>Profession:</th>
      <td><?php echo $mariage_contact->getProfession() ?></td>
    </tr>
  </tbody>
</table>
