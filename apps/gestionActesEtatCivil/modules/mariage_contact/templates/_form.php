<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('mariage_contact/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<table class="tableau">
    <div class="bouton">
      <!-- Permet de mettre en place le bouton retour dans les 2 cas de formulaire possible : Vierge ou en édition -->
      <?php if (!$form->getObject()->isNew()) { ?>
            &nbsp;<?php echo link_to('Supprimer', 'mariage_contact/delete?id='.$form->getObject()->getId().'&mariage_id='.$form->getObject()->getMariage_id(), array('method' => 'delete', 'confirm' => 'Êtes vous sure de vouloir effectuer cette suppression ?')) ?>
            <a href="<?php echo url_for('mariage/show?id='.$form->getObject()->getMariageId()) ?>">Retour</a>
      <?php } else { ?>
            <a href="<?php echo url_for('mariage/show?id='.$sf_request->getParameter('mariage_id')) ?>">Retour</a>
            <?php } ?>
    </div>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="Enregistrer" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
