<h1>Génération des documents pour l'acte n°<?php echo $mariage->getId() ?></h1>

<div class="bouton">
    <table class="pop_up_tableau">
        <tr>
            <th>
                Génération de l'acte :
            </th>
            <td>
                <a href="<?php echo url_for('genererActes_mariage', array("id" => $mariage->getId())) ?>">Générer Acte</a>
            </td>
        </tr>
        <tr>
            <th>
                Génération de l'acte Plurilingue :
            </th>
            <td>
                <a href="<?php echo url_for('genererActesPlurilingues_mariage', array("id" => $mariage->getId())) ?>">Acte Plurilingues</a>
            </td>
        </tr>
        <tr>
            <th>
                Génération de l'article de Loi :
            </th>
            <td>
                <a href="<?php echo url_for('genererArticle_loi_mariage', array("id" => $mariage->getId())) ?>">Article loi</a>
            </td>
        </tr>
        <tr>
            <th>
                Génération du dossier Tribunal :
            </th>
            <td>
                <a href="<?php echo url_for('genererDossier_tribunal', array("id" => $mariage->getId())) ?>">Dossier Tribunal</a>
            </td>
        </tr>
        <tr>
            <th>
                Génération de l'avis de mention Divorce pour le procureur :
            </th>
            <td>
                <a href="<?php echo url_for('genererAvis_mention_divorce_procureur', array("id" => $mariage->getId())) ?>">A.M. Divorce Proc</a>
            </td>
        </tr>
        <tr>
            <th>
                Génération de l'avis de mention de mariage de l'époux :
            </th>
            <td>
                <a href="<?php echo url_for('genererAvis_mention_mariage_epoux', array("id" => $mariage->getId())) ?>">A.M Conjoint 1</a>
            </td>
        </tr>
        <tr>
            <th>
                Génération de l'avis de mention de mariage de l'épouse :
            </th>
            <td>
                <a href="<?php echo url_for('genererAvis_mention_mariage_epouse', array("id" => $mariage->getId())) ?>">A.M. Conjoint 2</a>
            </td>
        </tr>
        <tr>
            <th>
                Génération de l'avis de mention pour le procureur :
            </th>
            <td>
                <a href="<?php echo url_for('genererAvis_mention_proc', array("id" => $mariage->getId())) ?>">A.M. Proc /!\</a>
            </td>
        </tr>
        <tr>
            <th>
                Génération de l'avis de mention pour le procureur:
            </th>
            <td>
                <a href="<?php echo url_for('genererAvis_mention_epoux_proc', array("id" => $mariage->getId())) ?>">A.M. Proc Conjoint 1</a>
            </td>
        </tr>
        <tr>
            <th>
                Génération de l'avis de mention pour le procureur:
            </th>
            <td>
                <a href="<?php echo url_for('genererAvis_mention_epouse_proc', array("id" => $mariage->getId())) ?>">A.M. Proc Conjoint 2</a>
            </td>
        </tr>
        <tr>
            <th>
                Génération du livret de famille :
            </th>
            <td>
                <a href="<?php echo url_for('genererLivretModeleMariage', array("id" => $mariage->getId())) ?>">Livret famille</a>
            </td>
        </tr>
    </table>
</div>

