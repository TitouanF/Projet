<?php
$prixttc = $unProduit['PRIXHT'] + ($unProduit['PRIXHT'] * $unProduit['TAUXTVA']/100);
echo '<div><p>'.img($unProduit['NOMIMAGE']).'<p></div>';
echo '<div><h2>'.$unProduit['LIBELLE'].'</h2>';
echo $unProduit['DETAIL']. '</div>';
echo 'Nombre de produits restants : ';
echo (int) $unProduit['QUANTITEENSTOCK'];
echo ' <br>Prix Unitaire : ' .$prixttc. ' euros </br>' ;
echo 'Quantité à commander :  <input type="number" value="0" min ="0" max="'.$unProduit['QUANTITEENSTOCK'].'" name="nombreproduits" size="1"/>';
echo '<br> <input type="submit" name="valid" value="Ajouter au panier"/>';
echo '<p>'.anchor('Visiteur/AfficherTousLesArticles#','Retour à la liste des articles').'</p>';

?>
