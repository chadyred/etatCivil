<?php slot('title') ?>
  <?php echo sprintf('Détails acte') ?>
<?php end_slot(); ?>

<?php use_helper('Date'); ?>

<?php $sf_user->setCulture('fr_FR');?>

<h1> Détails acte de <?php echo $naissance->getTypeActe() ?>
    n°<?php echo $naissance->getId() ?></h1>

<div id="main">

    <div class="bouton">
        <a href="<?php echo url_for('EditerActeNaissance', $naissance) ?>">Editer Acte</a>
        <a href="<?php echo url_for('Show_MentionsActeNaissance', $naissance) ?>">Mention marginale</a>
        <?php
        if (!$naissance->getEnfant() == null) {
        ?>
            <a href="<?php echo url_for('naissance_enfant_show', $naissance)?>"> Voir enfant </a>
        <?php
        }
        if ($naissance->compteLesContacts()>0) {
        ?>
            <a href="<?php echo url_for('Show_naissance_parents', $naissance) ?>">Voir Déclarant(s)</a>
        <?php
        }
        ?>

        <a href="<?php echo url_for('show_scansRegistre_Naissance', $naissance) ?>">Scan(s) registre</a>
        <?php echo link_to('Documents', 'naissance/popUpDocuments/?id='.$naissance->getId(), array(
                                    'popup' => array('Documents', 'width=900,height=500,left=320,top=0') )) ?>
        &nbsp;
        <a href="<?php echo url_for('naissance/index') ?>">Retour liste</a>
    </div>

    <table class="tableau">
        <tbody>
            <tr>
                <th>Numéro acte:</th>
                <td><?php echo $naissance->getNumeroActe() ?></td>
            </tr>
            <tr>
                <th>Numéro ordre:</th>
                <td><?php echo $naissance->getNumeroOrdre() ?></td>
            </tr>
            <tr>
                <th>Type acte:</th>
                <td><?php echo $naissance->getTypeActe() ?></td>
            </tr>
            <tr>
                <th>Date acte:</th>
                <td><?php echo format_date($naissance->getDateActe(), "dd/MM/yyyy") ?></td>
            </tr>
            <tr>
                <th>Heure acte:</th>
                <td><?php echo $naissance->getHeureActe() ?></td>
            </tr>
            <tr>
                <th>Date reconnaissance:</th>
                <td><?php echo format_date($naissance->getDateReconnaissance(), "dd/MM/yyyy")?></td>
            </tr>
            <tr>
                <th>Lieu reconnaissance:</th>
                <td><?php echo $naissance->getLieuReconnaissance() ?></td>
            </tr>
        </tbody>
    </table>

    <sub class="InfoActe">
            <h3>Informations sur l'acte : </h3>

<!-- On affiche ici si l'enfant a correctement été saisi
**      Si il a déja été saisi, on ne donne pas la possibilité d'en ajouter un autre
**      Sinon on affiche le bouton permettant de le créé
-->
            <?php
            if ($naissance->getEnfant() == null)
            {?>
                <img src="/images/KO.png" alt="Aucun enfant enregistré"/>
                <a>Enfant non enregistré</a>
                <a href="<?php echo url_for('naissance_enfant_new', array('id' => $naissance->getId())) ?>">
                    <img src="/images/add.png" alt="Ajouter Enfant" title="Ajouter Enfant" />
                </a>

            <?php
            } else {
            ?>
                <img src="/images/ok.png" alt="Succès enfant enregistré"/>
                <a>  Enfant enregistré </a>
            <?php
            }
            ?>

            <br />

<!--
* Permet l'affichage des information concernant les parents de l'enfant
* La consultation ( pour modification, verification, suppression )
* Si ils ne sont pas présent, on active le bouton d'ajout
*
-->
            <?php if ($naissance->getTypeActe() == "reconnaissance antérieure")
            {
                $père = "Déclarant";
                $mère = "Déclarante";
            } else {
                $père = "Père";
                $mère = "Mère";
            } ?>

            <?php if (!$naissance->PereIsPresent()) { ?>
                <img src="/images/KO.png" alt="le père n'es pas enregistré "/>
                <a> <?php echo $père ?> non enregistré </a>
                <a href="<?php echo url_for('naissance_acteur_newPere', array('id' => $naissance->getId())) ?>">
                    <img src="/images/add.png" alt="Ajouter Père" title="Ajouter Père" />
                </a>
            <?php } else { ?>
                <img src="/images/ok.png" alt="Succès père enregistré"/>
                <a> <?php echo $père ?> enregistré </a>
            <?php } ?>

            <br />

            <?php if (!$naissance->MereIsPresent()){ ?>
                <img src="/images/KO.png" alt="Succès contact(s) enregistré(s) "/>
                <a> <?php echo $mère ?> non enregistrée </a>
                <a href="<?php echo url_for('naissance_acteur_newMere', array('id' => $naissance->getId())) ?>">
                    <img src="/images/add.png" alt="Ajouter Mère" title="Ajouter Mère" />
                </a>
            <?php } else { ?>
                <img src="/images/ok.png" alt="Succès contact(s) enregistré(s) "/>
                <a> <?php echo $mère ?> enregistrée</a>
            <?php } ?>

            <br />

<!--
**  Ce test permet de vérifié la présence d'un déclarant dans l'acte
**  Il averti de l'absence d'un déclarant, et de la présence du déclarant
**  il affiche une erreur en cas d'un trop grand nombre de déclarant
-->
            <?php if( $naissance->declarantIsPresent() == 1){ ?>
                <img src="/images/ok.png" alt="Succès contact(s) enregistré(s) "/>
                <a><?php echo $naissance->getNbDeclarant()?> Déclarant(s) présent(s) </a>
            <?php
                } else if($naissance->declarantIsPresent() == -1){ ?>
                <img src="/images/attention.png" alt="Trop de déclarant" />
                <a>Trop de déclarants !!</a>
            <?php } else { ?>
                <img src="/images/KO.png" alt="Absence de contact" />
                <a> Pas de déclarants </a>
                <a href="<?php echo url_for('naissance_acteur_new', array('id' => $naissance->getId())) ?>">
                    <img src="/images/add.png" alt="Ajouter un declarant" title="Ajouter un declarant" />
                </a>
            <?php } ?>
        </sub>
</div>