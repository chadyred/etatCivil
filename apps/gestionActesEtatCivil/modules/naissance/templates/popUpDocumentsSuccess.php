<h1>Génération des documents pour l'acte n°<?php echo $naissance->getId() ?></h1>

<div class="bouton">
    <table class="pop_up_tableau">
        <tbody>
            <tr>
                <th>
                    Génération de l'acte :
                </th>
                <td>
                    <!-- Si l'acte en question est un acte de naissance -->
                    <?php if ($naissance->getTypeActe() == "naissance") {?>
                                <!-- On affiche un bouton lien vers le document des actes de naissances -->
                                <a href="<?php echo url_for('genererActes_naissance', array("id" => $naissance->getId())) ?>">Acte de Naissance</a>
                    <!-- Si l'acte en question est un acte de reconnaissance antérieure -->
                    <?php } else if ($naissance->getTypeActe() == "reconnaissance antérieure") { ?>
                                <!-- on vien tester si le pere est present -->
                                <?php if ($naissance->PereIsPresent() == 0 ) {  ?>
                                    <!-- Si Non ==> On route vers le document ou seulement la mere est declarante -->
                                    <a href="<?php echo url_for('genererActes_reconnaissanceAnt_M', array("id" => $naissance->getId())) ?>">Rec. Antérieure</a>
                                <!-- On vient tester si la mere est presente -->
                                <?php } else if ($naissance->MereIsPresent() == 0) { ?>
                                    <!-- Si non on route vers le document ou seulement le pere est declarant -->
                                    <a href="<?php echo url_for('genererActes_reconnaissanceAnt_P', array("id" => $naissance->getId())) ?>">Rec. Antérieure</a>
                                <!-- Sinon les deux parents sont présent -->
                                <?php } else { ?>
                                    <!-- On route vers le 3eme modele de document ou les 2 parents sont présent -->
                                    <a href="<?php echo url_for('genererActes_reconnaissanceAnt_PM', array("id" => $naissance->getId())) ?>">Rec. Antérieure</a>
                                <?php } ?>
                    <!-- Si l'acte est un acte de reconnaissance postérieure -->
                    <?php } else if ($naissance->getTypeActe() == "reconnaissance postérieure") { ?>
                                <!-- On affiche un bouton lien vers le document des actes de reconnaissance postérieure -->
                                <a href="<?php echo url_for('genererActes_reconnaissancePost', array("id" => $naissance->getId())) ?>">Rec. Postérieure</a>
                    <!-- Si l'acte est un acte de Changement de nom -->
                    <?php } else if ($naissance->getTypeActe() == "changement de nom") { ?>
                                <!-- On affiche un bouton lien vers le document des actes de reconnaissance postérieure -->
                                <a href="<?php echo url_for('genererActes_changementDeNom', array("id" => $naissance->getId())) ?>">Chgt. de Nom</a>
                    <?php } ?>
                </td>
             </tr>

             <!-- Si l'acte en question est un acte de reconnaissance antérieure -->
             <?php if ($naissance->getTypeActe() == "reconnaissance antérieure") { ?>
                 <tr>
                    <th>
                        Acte communicable reconnaissance anté.
                    </th>
                    <td>
                        <!-- on vien tester si le pere est present -->
                        <?php if ($naissance->PereIsPresent() == 0 ) {  ?>
                            <!-- Si Non ==> On route vers le document ou seulement la mere est declarante -->
                            <a href="<?php echo url_for('genererActeCommunicable_recoAntM', array("id" => $naissance->getId())) ?>">Acte communicable</a>
                        <!-- On vient tester si la mere est presente -->
                        <?php } else if ($naissance->MereIsPresent() == 0) { ?>
                            <!-- Si non on route vers le document ou seulement le pere est declarant -->
                            <a href="<?php echo url_for('genererActeCommunicable_recoAntP', array("id" => $naissance->getId())) ?>">Acte communicable</a>
                        <!-- Sinon les deux parents sont présent -->
                        <?php } else { ?>
                            <!-- On route vers le 3eme modele de document ou les 2 parents sont présent -->
                            <a href="<?php echo url_for('genererActeCommunicable_recoAntPM', array("id" => $naissance->getId())) ?>">Acte communicable</a>
                        <?php } ?>
                    </td>
                 </tr>
             <?php } ?>

             <tr>
                <th>
                    Génération de l'acte Plurilingue :
                </th>
                <td>
                    <a href="<?php echo url_for('genererActesPlurilingues_naissance', array("id" => $naissance->getId())) ?>">Acte Plurilingues</a>
                </td>
             </tr>
             <tr>
                <th>
                    Génération de l'avis de changement de nom :
                </th>
                <td>
                    <a href="<?php echo url_for('genererAvis_chgt_nom', array("id" => $naissance->getId())) ?>">Avis Chgt de Nom</a>
                </td>
             </tr>
             <tr>
                <th>
                    Génération de l'avis de Reconnaissance Postérieure :
                </th>
                <td>
                    <a href="<?php echo url_for('genererAvisReconnaissancePost', array("id" => $naissance->getId())) ?>">Avis Reco. Post</a>
                </td>
             </tr>
             <tr>
                <th>
                    Génération du Livret de Naissance
                </th>
                <td>
                    <a href="<?php echo url_for('genererLivretModeleNaissance', array("id" => $naissance->getId())) ?>">Livret de Famille</a>
                </td>
             </tr>
        </table>
    </tbody>
</div>

