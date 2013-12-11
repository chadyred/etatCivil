<!--  Là, libre à vous d'utiliser un helper à la place -->
    <?php $routeName = sfContext::getInstance()->getRouting()->getCurrentInternalUri(false)?>

    <?php
        if(strpos($routeName, '?') !== false)
            $routeName .= "&";
        else
            $routeName .= "?";
    ?>

<?php echo link_to('Début', $routeName.'page=1') ?>

<?php echo link_to('Précédent', $routeName.'page='.$pager->getPreviousPage()) ?>

<?php foreach ($pager->getLinks() as $page): ?>
    <?php if ($pager->getPage() == $page): ?>
        <?php echo $page ?> <!-- Cas de la page courante, affichée sans lien-->
    <?php else: ?>
        <?php echo link_to($page, $routeName."page=$page") ?> <!-- Cas des pages précédentes ou suivantes, affichées avec un lien -->
    <?php endif; ?>
<?php endforeach; ?>

<?php echo link_to('Suivant', $routeName.'page='.$pager->getNextPage()) ?>

<?php echo link_to('Dernier', $routeName.'page='.$pager->getLastPage()) ?>
