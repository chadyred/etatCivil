<!-- Layout Frontend -->
<?php use_helper('lienBackend') ;  ?>

<!-- apps/frontend/templates/layout.php -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

    <head>
        <title>
            <?php if (!include_slot('title')): ?>
                Application EtatCivil
            <?php endif; ?>
        </title>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_javascripts() ?>
        <?php include_stylesheets() ?>
    </head>

    <body>
        <!-- Le squelette du Layout -->
        <div id='conteneur'>
          <!-- Ici le squelette de la partie Top ==> Banniere -->
          <div id='top'>
              <a href="<?php echo url_for('@Menu_selection') ?>" class='logo_vor'>
                <img src="/images/design/logo.png" alt="Logo ville" title="Logo ville" />
              </a>


              <p class='boutons_top'>
                <a href="<?php echo url_for('@Menu_selection') ?>" class='bouton' > Retour Acceuil </a>
                <!-- Si l'utilisateur possède les droits Admin on affiche le
                     bouton d'accès à l'administration des données-->
                <?php if($sf_user->getAttribute("droits") == "admin") {?>
                        <a href="<?php echo url_for('/backend.php') ?>" class='bouton'> Administration </a>
                        <!-- décommenter la ligne ci dessous pour créer un lien vers vers le backend en mode DEV -->
                        <?php // echo link_to('Admin en DEV', cross_app_link_to('backend', '@homepage')) ; ?>
                <?php } ?>
              </p>
          </div>

          <!-- Le header est ici pour donner de la couleur -->
          <div id='header'>
              <div class ="title_head">
                  <h1>Gestion des actes d'<span>Etat-Civil.</span></h1>
              </div>

              <a href="<?php echo url_for('@Menu_logIn')?>" class="image_head">
                    <img src="/images/logoB.png" alt="Gestion des actes d'Etat civil" />
              </a>
      
              <div class="messages_erreurs">
                  <?php if ($sf_user->hasFlash('notice')): ?>
                    <div class="flash_notice">
                        <?php echo $sf_user->getFlash('notice') ?>
                    </div>
                    <?php endif; ?>

                <?php if ($sf_user->hasFlash('error')): ?>
                    <div class="flash_error">
                        <?php echo $sf_user->getFlash('error') ?>
                    </div>
                    <?php endif; ?>
              </div>
            
          </div>

          <!-- Centre contient toujours les élements de la page à affichés-->
          <div id='centre'>
                <?php echo $sf_content ?>
          </div>

          <div id='footer'>
                <div class="logoF">
                    <div id="block1">
                        <img src="/images/logo_voreppe.png" alt="logoVoreppe"/>
                        <p>Développé à l'aide du Framework Symfony</p>
                        <p>2010 - 2011 Boyer Jimmy / 2011 - 2012 Flament Guillaume / 2012 - 2013 Paccalet Florent</p>
                        <p>Logiciel sous licence GNU LGPL</p>
                    </div>
                </div>
          </div>
        </div>     
    </body>
</html>