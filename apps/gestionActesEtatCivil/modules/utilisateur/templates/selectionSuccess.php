<h1>Menu</h1>

<div id="rechercheEdition">
    <legend class="title">Recherche et Edition</legend>
        <form action="<?php echo url_for('@Liste_Naissance')?>"> <input type="submit" value="Actes de Naissance" /> </form>
        <form action="<?php echo url_for('@Liste_Mariage')?>"> <input type="submit" value="Actes de Mariage" /> </form>
        <form action="<?php echo url_for('@Liste_Deces')?>"> <input type="submit" value="Actes de Décès" /> </form>
</div>
<br/>
<div id="TablesAnnDec">
    <legend class="title">Génération documents</legend>
        <form method="get" action="<?php echo url_for('@Generation_Tables_Annuelle')?>">
            
            <input type="submit" value="Tables Annuelle" />
            <?php echo $form; ?>
        </form>
        <form method="get" action="<?php echo url_for('@Generation_Tables_Decenale')?>">
            <input type="submit" value="Tables Décennale"  />
            <?php echo $form; ?>
        </form>
</div>