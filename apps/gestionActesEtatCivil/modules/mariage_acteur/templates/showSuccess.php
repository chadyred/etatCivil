<h1>Détails <?php echo $mariage_acteur->getTypeActeur() ?> : acte mariage n°
                <?php echo $mariage_acteur->getMariageId() ?></h1>

<table class="tableau">
  <div class="bouton">
      <a href="<?php echo url_for('mariage_acteur/edit?id='.$mariage_acteur->getId()) ?>">Editer Acteur</a>

      <a href="<?php echo url_for('mariage_acteur/ShowByMariage?mariage_id='.$mariage_acteur->getMariage_id()) ?>">Conjoint1/Conjoint2</a>
  </div>
  <tbody>
    <tr>
      <th>Id :</th>
      <td><?php echo $mariage_acteur->getId() ?></td>
    </tr>
    <tr>
      <th>Mariage :</th>
      <td><?php echo $mariage_acteur->getMariageId() ?></td>
    </tr>
    <tr>
      <th>Nom :</th>
      <td><?php echo $mariage_acteur->getNom() ?></td>
    </tr>
    <tr>
      <th>Prénom :</th>
      <td><?php echo $mariage_acteur->getPrenom() ?></td>
    </tr>
    <tr>
      <th>Type acteur :</th>
      <td><?php echo $mariage_acteur->getTypeActeur() ?></td>
    </tr>
    <tr>
      <th>Date naissance :</th>
      <td><?php echo $mariage_acteur->getDateNaissance() ?></td>
    </tr>
    <tr>
      <th>Lieu naissance :</th>
      <td><?php echo Ville_france::getVilleDepartement($mariage_acteur->getLieuNaissance()) ?></td>
    </tr>
    <tr>
      <th>Domicile :</th>
      <td><?php echo $mariage_acteur->getDomicile() ?></td>
    </tr>
    <tr>
      <th>Résidence :</th>
      <td><?php echo $mariage_acteur->getResidence() ?></td>
    </tr>
    <tr>
      <th>Profession :</th>
      <td><?php echo $mariage_acteur->getProfession() ?></td>
    </tr>
    <tr>
      <th>Etat antérieur mariage :</th>
      <td><?php echo $mariage_acteur->getEtatAnterieurMariage() ?></td>
    </tr>
    <tr>
      <th>Nom prénom précédent conjoint:</th>
      <td><?php echo $mariage_acteur->getNomPrenomPrecConjoint() ?></td>
    </tr>
  </tbody>

  <?php $mariage = $mariage_acteur->getMariage(); ?>

  <sub class="InfoActe">
    <h3>Info <?php echo $mariage_acteur->getTypeActeur() ?></h3>

    <?php if($mariage_acteur->getTypeActeur()=="conjoint1") {?>
        <?php if ($mariage->parentsConjoint1Present() == "Parents présents") {?>
            <img src="/images/ok.png" alt="Parents Epoux enregistré"  />
            <a>Parents Conjoint1 enregistré</a>
            <br />
        <?php
        } else {
            echo "Conjoint 1 : ".$mariage->parentsConjoint1Present();
            ?>
            <br />
            <?php
            if ($mariage->parentsConjoint1Present() == "Père absent" |
                    $mariage->parentsConjoint1Present() == "Parents absents" ) { ?>
                            <a>Ajouter Pere</a>
                            <a href="<?php echo url_for('mariage_contact/newPereEpoux?mariage_id='
                                    .$mariage->getId())?>">
                            <img src="/images/add.png" alt="ajouter Parent Conjoint 1" title="Ajout Epoux" />
                            </a>
                            <br />
            <?php
            }
            if ($mariage->parentsConjoint1Present() == "Mère absente" |
                    $mariage->parentsConjoint1Present() == "Parents absents" ) { ?>
                            <a>Ajouter Mere</a>
                            <a href="<?php echo url_for('mariage_contact/newMereEpoux?mariage_id='.$mariage->getId()) ?>">
                                <img src="/images/add.png" alt="ajouter Parent Epoux" title="Ajout Epoux" />
                            </a>
                            <br />
            <?php
            }
        }

        if (($mariage->compteLesTemoinsConjoint1()+$mariage->compteLesTemoinsConjoint2())<4) {
            if ($mariage->compteLesTemoinsConjoint1()<2) {

                echo "Conjoint 1  : ".$mariage->compteLesTemoinsConjoint1()." témoin(s)";
                ?>
                <a href="<?php echo url_for('mariage_contact/newTemoinEpoux?mariage_id='.$mariage->getId()) ?>">
                                    <img src="/images/add.png" alt="ajouter témoin Epoux" title="Ajout témoin Epoux" />
                </a>
                <?php
            } else {
                    echo "Conjoint 1  : ".$mariage->compteLesTemoinsConjoint1()." témoin(s)";
            }
    }

    } else if ($mariage_acteur->getTypeActeur() == "conjoint2") {?>
        <?php
        if ($mariage->parentsConjoint2Present() == "Parents présents") {
        ?>
            <img src="/images/ok.png" alt="Parents Epouse enregistrés"  />
            <a>Parents conjoint2 présent</a>
            <br />

        <?php
        } else {
                echo "Conjoint 2 : ".$mariage->parentsConjoint2Present(); ?>
                <br />            <?php
                if ($mariage->parentsConjoint2Present() == "Père absent" |
                        $mariage->parentsConjoint2Present() == "Parents absents" ) { ?>
                            <a>Ajouter Pere</a>
                            <a href="<?php echo url_for('mariage_contact/newPereEpouse?mariage_id='.$mariage->getId()) ?>">
                                <img src="/images/add.png" alt="ajouter Parent Epouse" title="Ajout pere Epouse" />
                            </a>
                            <br />
        <?php
                        }
        if ($mariage->parentsConjoint2Present() == "Mère absente" |
                $mariage->parentsConjoint2Present() == "Parents absents" ) { ?>
                    <a>Ajouter Mere</a>
                    <a href="<?php echo url_for('mariage_contact/newMereEpouse?mariage_id='.$mariage->getId()) ?>">
                        <img src="/images/add.png" alt="ajouter Parent Epouse" title="Ajout mere Epouse" />
                    </a>
                    <br />
        <?php
                }
        }

        if ($mariage->parentsConjoint2Present()<2) {

            echo "Conjoint 2 : ".$mariage->parentsConjoint2Present()." témoin(s)"; ?>

            <a href="<?php echo url_for('mariage_contact/newTemoinEpouse?mariage_id='.$mariage->getId()) ?>">
                    <img src="/images/add.png" alt="ajouter témoin Epouse" title="Ajout témoin Epouse" />
            </a>

        <?php } else {
                echo "Conjoint 2 : ".$mariage->parentsConjoint2Present()." témoin(s)";
        }
    } ?>
  </sub>
</table>