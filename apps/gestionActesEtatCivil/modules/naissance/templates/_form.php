<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('naissance/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="tableau">
    <div class="bouton">
      <a href="<?php echo url_for('naissance/index') ?>">Retour liste</a>
      <?php if (!$form->getObject()->isNew()): ?>
      &nbsp;  <a href="<?php echo url_for('naissance/show?id='.$sf_request->getParameter("id")) ?>">Retour détail</a>
              <?php echo link_to('Supprimer', 'naissance/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Êtes vous sure de vouloir supprimer cet acte?')) ?>
      <?php endif; ?>
    </div>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;
          <?php endif; ?>
            <input type="submit" value="Enregistrer" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
