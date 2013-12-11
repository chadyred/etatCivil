<h1>Génération des documents pour l'acte n°<?php echo $deces->getId() ?></h1>

<div class="bouton">
    <table class="pop_up_tableau">
        <tr>
            <th>
                Génération de l'acte :
            </th>
            <td>
                <?php if($deces->getTypeActe() == "décès") { ?>
                    <a href="<?php echo url_for('genererActes_deces', array("id" => $deces->getId())) ?>">Générer Acte</a>
                <?php } else if($deces->getTypeActe() == "transcription") { ?>
                    <a href="<?php echo url_for('genererActesTranscription_deces', array("id" => $deces->getId())) ?>">Générer Acte(T)</a>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <th>
                Génération de l'acte Communicable :
            </th>
            <td>
                <a href="<?php echo url_for('genererActeCommunicable_deces', array("id" => $deces->getId())) ?>">Acte Communicable</a>
            </td>
        </tr>
        <tr>
            <th>
                Génération de l'acte Plurilingue :
            </th>        
            <td>
                <a href="<?php echo url_for('genererActesPlurilingues_deces', array("id" => $deces->getId())) ?>">Acte Plurilingues</a>
            </td>
        </tr>
        <tr>
            <th>
                Génération document Impots :
            </th>
            <td>
                <a href="<?php echo url_for('genererDoc_Impots_deces', array("id" => $deces->getId())) ?>">Doc. Impôts </a>
            </td>
        </tr>
        <tr>
            <th>
                Génération Avis Mention :
            </th>
            <td>
                <a href="<?php echo url_for('genererAvis_mention_deces', array("id" => $deces->getId())) ?>">Avis de mention </a>
            </td>
        </tr>
        <tr>
            <th>
                Génération avis de mention Procureur :
            </th>
            <td>
                <a href="<?php echo url_for('genererAvis_mention_deces_procureur', array("id" => $deces->getId())) ?>">A. mention PROC </a>
            </td>
        </tr>
        <tr>
            <th>
                Génération avis de mention Varces :
            </th>
            <td>
                <a href="<?php echo url_for('genererAvis_mention_deces_varces', array("id" => $deces->getId())) ?>">A. mention Varces </a>
            </td>
        </tr>
        <tr>
            <th>
                Génération avis de transcription :
            </th>
            <td>
                <a href="<?php echo url_for('genererAvis_transcription_deces', array("id" => $deces->getId())) ?>">A. transcription </a>
            </td>
        </tr>
        <tr>
            <th>
                Génération avis de mention Notoriete :
            </th>
            <td>
                <a href="<?php echo url_for('genererAvis_mention_Notoriete', array("id" => $deces->getId())) ?>">A.M. Notoriete </a>
            </td>
        </tr>
        <tr>
            <th>
                Génération avis de mention Notoriete Procureur:
            </th>
            <td>
                <a href="<?php echo url_for('genererAvis_mention_Notoriete_procureur', array("id" => $deces->getId())) ?>">A.M. Notoriete Proc</a>
            </td>
        </tr>
    </table>
</div>

