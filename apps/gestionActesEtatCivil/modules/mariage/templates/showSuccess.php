<?php use_helper('Date'); ?>

<?php $sf_user->setCulture('fr_FR');?>

<h1>Détails de l'acte de mariage n°
    <?php echo $mariage->getId() ?>
</h1>

<div class="bouton">
    <a href="<?php echo url_for('mariage/edit?id='.$mariage->getId()) ?>">Editer Acte</a>
    <?php
    if ($mariage->Conjoint1IsPresent() || $mariage->Conjoint2IsPresent()) {
        ?><a href="<?php echo url_for('mariage_acteur/ShowByMariage?mariage_id='.$mariage->getId()) ?>">Conjoint 1/Conjoint 2</a> <?php
    }
    if (!($mariage->parentsConjoint1Present() == "Parents absents") ||
        !($mariage->parentsConjoint2Present() == "Parents absents")) {
        ?><a href="<?php echo url_for('mariage_contact/ShowParentsByMariage?mariage_id='.$mariage->getId()) ?>">Voir Parents</a> <?php
    }
    ?>

    <a href="<?php echo url_for('mariage_contact/ShowTemoinsByMariage?mariage_id='.$mariage->getId()) ?>">Voir Témoins</a>
    <a href="<?php echo url_for('mention_marginalemariage/ShowByMariage?mariage_id='.$mariage->getId()) ?>">Mention marginale</a>
    <a href="<?php echo url_for('image_RegistreMariage/showByMariage?mariage_id='.$mariage->getId()) ?>">Scan(s) registre</a>
    <?php echo link_to('Documents', 'mariage/popUpDocuments/?id='.$mariage->getId(), array(
                                    'popup' => array('Documents', 'width=900,height=800,left=320,top=0') )) ?>
    
    &nbsp;
    <a href="<?php echo url_for('mariage/index') ?>">Retour liste</a>
</div>

<table class="tableau">  
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $mariage->getId() ?></td>
    </tr>
    <tr>
      <th>Numéro acte:</th>
      <td><?php echo $mariage->getNumeroActe() ?></td>
    </tr>
    <tr>
      <th>Numéro ordre:</th>
      <td><?php echo $mariage->getNumeroOrdre() ?></td>
    </tr>
    <tr>
      <th>Date mariage :</th>
      <td><?php echo format_date($mariage->getDateMariage(), "dd/MM/yyyy") ?></td>
    </tr>
    <tr>
      <th>Date acte:</th>
      <td><?php echo format_date($mariage->getDateActe(), "dd/MM/yyyy") ?></td>
    </tr>
    <tr>
      <th>Heure acte:</th>
      <td><?php echo $mariage->getHeureActe() ?></td>
    </tr>
    <tr>
      <th>Date réception contrat:</th>
      <td><?php echo format_date($mariage->getDateReceptionContrat(), "dd/MM/yyyy") ?></td>
    </tr>
    <tr>
      <th>Nom prénom notaire:</th>
      <td><?php echo Notaires::getNPNotaire($mariage->getNomPrenomNotaire()) ?></td>
    </tr>
    <tr>
      <th>Adresse notaire:</th>
      <td><?php echo Notaires::getAdresseNotaire($mariage->getNomPrenomNotaire()) ?></td>
    </tr>
    <tr>
      <th>Officier d'état-civil:</th>
      <td><?php echo Officiers::getNPOfficier($mariage->getOfficierEtatCivil()) ?></td>
    </tr>
  </tbody>

  <br />

<!-- Mise en forme du panneau d'information -->

  <sub class="InfoActe">

    <h3>Informations sur l'acte :</h3>
<!--
* On place dans le panneau d'information les
* quick info sur les mariés
-->
    <?php
    if ($mariage->Conjoint1IsPresent()) {
    ?>
        <img src="/images/ok.png" alt="Epoux enregistré"  />
        <a>Conjoint 1 enregistré</a>

    <?php
    }else {
    ?>
        <img src="/images/KO.png" alt="Conjoint 1 non enregistré"  />
        <a>Conjoint 1 non enregistré </a>
        <a href="<?php echo url_for('mariage_acteur/newEpoux?mariage_id='.$mariage->getId()) ?>">
            <img src="/images/add.png" alt="ajouter Epoux" title="Ajout Conjoint 1" />
        </a>
    <?php
    }
    ?>

    <br />

    <?php
    if ($mariage->Conjoint2IsPresent()) {
    ?>
        <img src="/images/ok.png" alt="Epouse enregistrée"  />
        <a>Conjoint 2 enregistré</a>
    <?php
    }else {
    ?>
        <img src="/images/KO.png" alt="Epouse non enregistrée"  />
        <a>Conjoint 2 non enregistrée </a>
        <a href="<?php echo url_for('mariage_acteur/NewEpouse?mariage_id='.$mariage->getId()) ?>">
            <img src="/images/add.png" alt="ajouter Epouse" title="Ajout Conjoint 2" />
        </a>
    <?php
    }
    ?>

    <br />


    </sub>
</table>