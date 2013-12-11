<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('Date'); ?>
<?php $sf_user->setCulture('fr_FR');?>


<!--  Cet élement va permettre de dissocier les recherches par Id,
      par Nom Prenom et par Date.   -->
<h1>Recherche sur les actes de naissance</h1>

<div class="bouton">
    <a href="<?php echo url_for('naissance/index') ?>">Retour</a>
</div>

<form action="<?php echo url_for('naissance/result') ?>" method="post" class="tableau">
    <table>
        <tbody>
            <?php echo $form; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Rechercher" />
                </td>
            </tr>
        </tfoot>
    </table>
</form>

<br />
