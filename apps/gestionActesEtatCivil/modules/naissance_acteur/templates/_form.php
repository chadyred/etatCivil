<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('naissance_acteur/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<table class="tableau">
    <div class="bouton">
        <a href="<?php echo url_for('naissance/index') ?>">Retour Liste</a>
      <?php if (!$form->getObject()->isNew()) {?>
      &nbsp;  <a href="<?php echo url_for('naissance/show?id='.$form->getObject()->getNaissance_Id()) ?>">Retour</a>
              <?php echo link_to('Supprimer', 'naissance_acteur/delete?id='.$form->getObject()->getId().'&naissance_id='.$form->getObject()->getNaissance_id(), array('method' => 'delete', 'confirm' => 'Êtes vous sure de vouloir effectuer cette suppression ?'));
      } else { ?>
              <a href="<?php echo url_for('naissance/show?id='.$form->getDefault('naissance_id') ) ?>">Retour</a>
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