<!-- apps/frontend/templates/layout_popUp.php -->
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
        <div id="conteneur">
            <div id="top">
                <div class="logo_vor">

                  
                </div>
            </div>

        

        <!-- Centre contient toujours les élements de la page à affichés-->
          <div id='centre'>
                <?php echo $sf_content ?>
          </div>

        </div>
    </body>
</html>