<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<h1>Identification</h1>
<?php //echo form_tag('login', array('method'=>'post', 'id'=>'frm1')); ?>
<?php //echo form_tag_for($form, '@login') ?>
<form action="<?php echo url_for('utilisateur/index') ?>" method="post" class="contact_form">
    <div class="identification">
        <legend>Connexion</legend> <br />
        <?php echo $form; ?>
        <input type="submit" value="Se connecter" />
    </div>
</form>