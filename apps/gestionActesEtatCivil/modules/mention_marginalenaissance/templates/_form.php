<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('mention_marginalenaissance/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<table class="tableau">
    <div class="bouton">
        
        <!-- Si on créé une nouvelle mention -->
        <?php if ($form->getObject()->isNew()): ?>
                <a href="<?php echo url_for('Show_MentionsActeNaissance', array( 'id' => $form->getDefault('naissance_id') ) ) ?>">Retour</a>
        <?php endif; ?>

        <!-- Si on édite une mention deja existante-->
        <?php if (!$form->getObject()->isNew()): ?>
            <?php echo link_to('Supprimer', 'mention_marginalenaissance/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Êtes vous sure de vouloir supprimer cette mention ?')) ?>
            &nbsp;<a href="<?php echo url_for('Show_MentionsActeNaissance', array( 'id' => $form->getObject()->getNaissanceId())) ?>">Retour</a>
            
        <?php endif; ?>
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
