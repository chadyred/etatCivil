<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('mention_marginalemariage/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<table class="tableau">
    <div class="bouton">
        <?php if (!$form->getObject()->isNew()) { ?>
            &nbsp;<?php echo link_to('Supprimer', 'mention_marginalemariage/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Êtes vous sure de vouloir supprimer cette mention ?')); ?>
            <a href="<?php echo url_for('mention_marginalemariage/ShowByMariage?mariage_id='.$form->getObject()->getMariageId()) ?>">Retour</a>
        <?php } else { ?>
                <a href="<?php echo url_for('mention_marginalemariage/ShowByMariage?mariage_id='.$sf_request->getParameter('mariage_id')) ?>">Retour</a>
        <?php  } ?>
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
