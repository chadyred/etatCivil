<!-- Layout Backend -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id='conteneur'>
        <div id='top'>
            <a href="" class='logo_vor'>
                <img src="/images/design/logo.png" alt="Watch My Desk - Show Off your Geekstation" title="Watch My Desk - Show Off your Geekstation" />
            </a>

              <p class='boutons_top'>
                <a href="<?php echo url_for('@Compte_User'); ?>" class='bouton'>Utilisateurs</a>
		<a href="<?php echo url_for('@Villes_france'); ?>" class='bouton'>Villes France</a>
		<a href="<?php echo url_for('@Officiers'); ?>" class='bouton'>Officiers</a>
		<a href="<?php echo url_for('@notaires'); ?>" class='bouton'>Notaires</a>
		<a href="/choixMenu" class='bouton'>Retour site</a>
              </p>

        </div>
        <div id='header'>
            	<div class='title_head'>
                   <h1>Administration <span>Etat-Civil.</span></h1>
                   <p>Cette partie du site est réservé à l'administration des données des
                        utilisateurs d'EtatCivil, des villes de France, des Officiers et des Notaires.</p>
                </div>
                <div class='case_quitter'>
                        <p>Pour retourner à l'application cliquer sur "Quitter".</p>
                        <a href="/"><img src='/images/design/quitter.png' alt="Quitter" title="Quitter" /></a>
                </div>
        </div>
        
        <div id='centre'><?php echo $sf_content ?></div>

        <div id='footer'>
            <div class="logoF">
                <div id="block1">
                    <img src="/images/logo_voreppe.png" alt="logoVoreppe"/>
                    <p>Développé à l'aide du Framework Symfony</p>
                    <p>2010 - 2011 Boyer Jimmy</p>
                    <p>Logiciel sous licence GNU LGPL</p>
                </div>
            </div>
        </div>
    </div>
    
  </body>
</html>