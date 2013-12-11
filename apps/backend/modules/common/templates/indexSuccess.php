<h1>Menu Administration</h1>

<p> Cette partie du site est réservé à l'administration des données des
    utilisateurs d'EtatCivil et des villes de France. Pour retourner
    à l'application cliquer sur "Quitter" </p>

<div class="rechercheEdition">
    <legend>Administration des données</legend>
        <form action="<?php echo url_for('@Compte_User')?>"> <input type="submit" value="Gestion des utilisateurs" /> </form>
        <form action="<?php echo url_for('@Villes_france')?>"> <input type="submit" value="Gestion des villes de France" /> </form>
</div>
