<?php
$prixttc = $unProduit['PRIXHT'] + ($unProduit['PRIXHT'] * $unProduit['TAUXTVA']/100);
echo '<div><p>'.img($unProduit['NOMIMAGE']).'<p></div>';
echo '<div><h2>'.$unProduit['LIBELLE'].'</h2>';
echo $unProduit['DETAIL']. '</div>';
echo 'Stock du produit : ' .$unProduit['QUANTITEENSTOCK'];
echo ' <br>Prix Unitaire : ' .$prixttc. ' euros </br>' ;


echo '<p>'.anchor('Visiteur/AfficherTousLesArticles#','Retour à la liste des articles').'</p>';

?>
